tt_content.teasermenu = FLUIDTEMPLATE
tt_content.teasermenu {
  templateName = TeaserMenu
  templateRootPaths {
    0 = EXT:teasermenu/Resources/Private/Templates/
    10 = {$teasermenu.templates.templateRootPath}
  }
  partialRootPaths {
    0 = EXT:teasermenu/Resources/Private/Partials/
    10 = {$teasermenu.templates.partialRootPath}
  }
  layoutRootPaths {
    0 = EXT:teasermenu/Resources/Private/Layouts/
    10 = {$teasermenu.templates.layoutRootPath}
  }

  settings {

  }
  dataProcessing {
    3 = TYPO3\CMS\Frontend\DataProcessing\DatabaseQueryProcessor
    3 {
      table = tx_teasermenu_domain_model_teaseritem
      pidInList = this
      as = menuItems
      where.data = field:uid
      where.wrap = parent=|
     orderBy = sorting

      dataProcessing >
      dataProcessing {
        3 >
        5 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
        5 {
          references.fieldName = custom_image
          as = image
        }
      }
    }
  }
}
