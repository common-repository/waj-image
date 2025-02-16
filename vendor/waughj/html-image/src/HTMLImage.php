<?php

declare( strict_types = 1 );
namespace WaughJ\HTMLImage;

use WaughJ\FileLoader\FileLoader;
use WaughJ\FileLoader\MissingFileException;
use WaughJ\HTMLAttributeList\HTMLAttributeList;
use function \WaughJ\TestHashItem\TestHashItemString;

class HTMLImage
{
	//
	//  PUBLIC
	//
	//////////////////////////////////////////////////////////

		public function __construct( string $local_src, FileLoader $loader = null, array $other_attributes = [] )
		{
			$missing_files = [];
			$absolute_src_versionless = self::generateSourceVersionless( $local_src, $loader );
			$show_version = self::testShowVersionAttribute( $other_attributes );

			try
			{
				$absolute_src = self::generateSource( $local_src, $loader, $show_version );
			}
			catch ( MissingFileException $e )
			{
				$absolute_src = $e->getFallbackContent();
				$missing_files[] = $e->getFilename();
			}

			try
			{
				$srcset = new SrcSet( $other_attributes[ 'srcset' ] ?? null, $loader, $show_version );
			}
			catch ( MissingFileException $e )
			{
				$srcset = $e->getFallbackContent();
				if ( !is_array( $e->getFilename() ) )
				{
					$missing_files[] = $e->getFilename();
				}
				else
				{
					array_merge( $missing_files, $e->getFilename() );
				}
			}

			$other_attributes = self::generateSizes( $other_attributes, $srcset );

			// Finally set properties.
			$this->original_arguments = $other_attributes;
			$this->local_src = $local_src;
			$this->absolute_src_versionless = $absolute_src_versionless;
			$this->absolute_src = $absolute_src;
			$this->loader = $loader;
			$this->html = self::generateHTML( $absolute_src, $srcset, $other_attributes );

			if ( !empty( $missing_files ) )
			{
				throw new MissingFileException( $missing_files, $this );
			}
		}

		private static function generateHTML( string $src, SrcSet $srcset, array $other_arguments )
		{
			$html_attributes = self::configureHTMLAttributes( $other_arguments );
			return "<img src=\"{$src}\"{$srcset->getAttributeText()}{$html_attributes->getAttributesText()} />";
		}

		private static function configureHTMLAttributes( array $other_arguments ) : HTMLAttributeList
		{
			$other_arguments[ 'alt' ] = TestHashItemString( $other_arguments, 'alt', '' );
			unset( $other_arguments[ 'show-version' ] ); // We don't want this to accidentally become an HTML attribute.
			unset( $other_arguments[ 'srcset' ] ); // Due to the complexity o' sources & the file loader, we handle this attribute manually.
			unset( $other_arguments[ 'autosized' ] ); // We don't want this to accidentally become an HTML attribute.
			return new HTMLAttributeList( $other_arguments );
		}

		public function __toString()
		{
			return $this->html;
		}

		public function print() : void
		{
			echo $this->html;
		}

		public function getHTML() : string
		{
			return $this->html;
		}

		public function getSource() : string
		{
			return $this->absolute_src;
		}

		public function getSourceVersionless() : string
		{
			return $this->absolute_src_versionless;
		}

		public function setAttribute( string $type, $value ) : HTMLImage
		{
			$new_attributes = $this->original_arguments;
			$new_attributes[ $type ] = $value;

			// If we’re manually changing this, make sure we say it’s no longer autosized,
			// or the constructor will o’erride our change.
			if ( $type === 'sizes' )
			{
				unset( $new_attributes[ 'autosized' ] );
			}

			return new HTMLImage( $this->local_src, $this->loader, $new_attributes );
		}

		public function addToClass( $value ) : HTMLImage
		{
			$old_value = $this->original_arguments[ 'class' ] ?? null;
			$new_value = ( $old_value !== null ) ? "{$old_value} {$value}" : $value;
			return $this->setAttribute( 'class', $new_value );
		}

		public function changeLoader( $loader ) : HTMLImage
		{
			return new HTMLImage( $this->local_src, $loader, $this->original_arguments );
		}

		// Lots o' classes based on this will need to use this.
		public static function testShowVersionAttribute( array $attributes ) : bool
		{
			// Defaults to true if not set.
			return ( bool )( $attributes[ 'show-version' ] ?? true );
		}



	//
	//  PRIVATE
	//
	//////////////////////////////////////////////////////////

		private static function generateSource( string $src, $loader, bool $show_version ) : string
		{
			return ( $loader !== null )
				? (
					( $show_version )
					? $loader->getSourceWithVersion( $src )
					: $loader->getSource( $src )
				)
				: $src;
		}

		private static function generateSourceVersionless( string $src, $loader ) : string
		{
			return ( $loader !== null )
				? $loader->getSource( $src )
				: $src;
		}

		private static function generateSizes( array $other_attributes, SrcSet $srcset ) : array
		{
			$sources_list = $srcset->getSources();

			// If sizes manually set, leave as is UNLESS that size was autogenerated by this method before,
			// in which case we want to autogenerate ’gain to reflect any possible srcset changes.
			//
			// Obviously there’s no point in generating sizes if there is no srcset ( it’s empty ).
			if ( ( ( $other_attributes[ 'autosized' ] ?? false ) || !array_key_exists( 'sizes', $other_attributes ) ) && !empty( $srcset->getSources() ) )
			{
				$sizes = [];
				$source_count = count( $sources_list );
				for ( $i = 0; $i < $source_count; $i++ )
				{
					$last_item = $i === $source_count - 1;
					$source = $sources_list[ $i ];
					$sizes[] = ( $last_item ) ? "{$source->getWidthTag()}px" : "(max-width: {$source->getWidthTag()}px) {$source->getWidthTag()}px";
				}
				$other_attributes[ 'sizes' ] = implode( ', ', $sizes );
				$other_attributes[ 'autosized' ] = true; // We need to keep track that we set these sizes in case we need to regenerate them.
			}
			return $other_attributes;
		}

		private $local_src;
		private $absolute_src;
		private $absolute_src_versionless;
		private $html;
		private $loader;
		private $original_arguments;
}
