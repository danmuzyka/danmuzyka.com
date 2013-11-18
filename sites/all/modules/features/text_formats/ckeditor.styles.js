/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/*
 * This file is used/requested by the 'Styles' button.
 * The 'Styles' button is not enabled by default in DrupalFull and DrupalFiltered toolbars.
 */
if(typeof(CKEDITOR) !== 'undefined') {
    CKEDITOR.addStylesSet( 'drupal',
    [
      {
        name : 'Headline',
        element : 'h1'
      },
      {
        name : 'Subheadline',
        element : 'h2'
      },
      {
        name : 'Subheadline 2',
        element : 'h3'
      },
      {
        name : 'Body text',
        element : 'p'
      },
      {
        name : 'Bolded body text',
        element : 'p',
        styles : {
          'font-weight' : 'bold'
        }
      },
      {
        name : 'Left image',
        element : 'img',
        styles : {
          'float' : 'left',
          'margin' : '0 5px 5px 0'
        }
      },
      {
        name : 'Right image',
        element : 'img',
        styles : {
          'float' : 'right',
          'margin' : '0 0 5px 5px'
        }
      },
      {
        name : 'Left paragraph',
        element : 'p',
        styles : {
          'float' : 'left'
        }
      },
      {
        name : 'Right paragraph',
        element : 'p',
        styles : {
          'float' : 'right'
        }
      },
      {
        name : 'Footnote',
        element : 'span',
        attributes : {
          'class' : 'notes'
        }
      },
      {
        name : 'Members table',
        element : 'table',
        attributes : {
          'class' : 'watertable'
        }
      },
      {
        name : 'Members dark row',
        element : 'td',
        attributes : {
          'class' : 'darker_row'
        }
      },

      /* Object Styles */

      {
        name : 'Image on Left',
        element : 'img',
        attributes :
        {
           'style' : 'padding: 5px; margin-right: 5px',
           'border' : '2',
           'align' : 'left'
        }
      },

      {
        name : 'Image on Right',
        element : 'img',
        attributes :
        {
          'style' : 'padding: 5px; margin-left: 5px',
          'border' : '2',
          'align' : 'right'
        }
      }
    ]);
}
