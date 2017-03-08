# EXT:teasermenu, a TYPO3 CMS Extension
_initially for TYPO3 7.6 LTS_

There are situations, where you want to build your own "teaser menu", where menu
items are added doubled or you build some fancy menu, which has also some custom spacer items
e.g. with different background images (just to make menu nicer).

This example extension provides a custom Content Element `tt_content.teasermenu` where the TYPO3
backend editor can easily add menu items directly in the content plugin (via IRRE). All menu items
are saved as `tx_teasermenu_domain_model_teaseritem` records on the page where the content element
is placed.

## Menu item types

Two types are added initially (Default, Spacer). You can add additional types easily via TCA/Overrides
functionality or simply via PageTSConfig in your extension/sitepackage/theme (howsoever you call).
 
## Layout field for type "Spacer"

Removing and adding additional items is also possible via a FormDataProvider or simply via PageTSConfig
in your extension/sitepackage/theme (howsoever you call):

```
TCEFORM.tx_teasermenu_domain_model_teaseritem {
    layout {
        // remove existing items
        removeItems := addToList()
        addItems {
            // add item with value "10" (it must be an integer!)
            10 = Gray
        }
    }
}
```
