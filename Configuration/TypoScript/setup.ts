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

  dataProcessing {
    1 = TYPO3\CMS\Frontend\DataProcessing\DatabaseQueryProcessor
    1 {
      table = tx_teasermenu_domain_model_teaseritem
      pidInList = this
      as = menuItems
      where.data = field:uid
      where.wrap = parent=|
      orderBy = sorting

      dataProcessing {
        1 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
        1 {
          references.fieldName = custom_image
          as = image
        }
        20 = TYPO3\CMS\Frontend\DataProcessing\DatabaseQueryProcessor
        20 {
          if.isTrue.field = target_page
          selectFields = title,nav_title,media
          pidInList.data = leveluid : 0
          recursive = 99
          table = pages
          where.field = target_page
          where.wrap = uid=|
          begin = 0
          as = targetPage
          languageField = sys_language_uid
          dataProcessing {
            1 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
            1 {
              if.isTrue.field = media
              references.fieldName = media
              as = images
            }
          }
        }
      }
    }
  }
}
