<?php
 
/*
 * Example PHP implementation used for the index.html example
 */
 
// DataTables PHP library
include( "DataTables.php" );
 
// Alias Editor classes so they are easy to use
use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Options,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate,
    DataTables\Editor\ValidateOptions;
 
// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'user' )
    ->fields(
        Field::inst( 'id' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'A first name is required' ) 
            ) ),
        Field::inst( 'name' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'A last name is required' )  
            ) ),
            Field::inst( 'mail' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'A first name is required' ) 
            ) ),
        Field::inst( 'contact' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'A last name is required' )  
            ) ),
            Field::inst( 'technology' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'A first name is required' ) 
            ) ),
        Field::inst( 'experience' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'A last name is required' )  
            ) )
      
    )
    ->process( $_POST )
    ->json();