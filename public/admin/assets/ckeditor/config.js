/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' },
	];

	config.allowedContent = true;
	config.extraAllowedContent = '*(*)';
	
	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	
	//config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
        config.removePlugins = 'elementspath';  // hide boday and p from footer
	config.format_tags = 'p;h1;h2;h3;pre';
        config.extraPlugins = 'wordcount';
        config.wordcount = {
             showParagraphs: false,
             showCharCount: true,
        }
        
        config.language = window.language;
        
        //config.extraPlugins = 'scayt';
        //config.scayt_sLang = 'en_GB';  
        //config.scayt_autoStartup = true;  

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
	//config.filebrowserBrowseUrl = baseUrl +'/assets/ckeditor/ckfinder/ckfinder.html?type=Images';
	config.filebrowserUploadUrl = baseUrl +'/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
        config.filebrowserImageUploadUrl = baseUrl +'/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
        config.filebrowserFlashUploadUrl =  baseUrl +'/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
