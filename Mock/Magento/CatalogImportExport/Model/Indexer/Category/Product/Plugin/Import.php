<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\CatalogImportExport\Model\Indexer\Category\Product\Plugin;

class Import
{
    public function afterImportSource(\Magento\ImportExport\Model\Import $subject, $import)
    {
        return $import;
    }
}
