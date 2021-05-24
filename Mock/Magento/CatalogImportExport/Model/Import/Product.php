<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\CatalogImportExport\Model\Import;


use Magento\ImportExport\Model\Import;

/**
 * Import entity product model
 *
 * @api
 *
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @since 100.0.2
 */
class Product extends \Magento\Framework\DataObject
{
    public const CONFIG_KEY_PRODUCT_TYPES = 'global/importexport/import_product_types';
    private const HASH_ALGORITHM = 'sha256';

    /**
     * Size of bunch - part of products to save in one step.
     */
    const BUNCH_SIZE = 20;

    /**
     * Size of bunch to delete attributes of products in one step.
     */
    const ATTRIBUTE_DELETE_BUNCH = 1000;

    /**
     * Pseudo multi line separator in one cell.
     *
     * Can be used as custom option value delimiter or in configurable fields cells.
     */
    const PSEUDO_MULTI_LINE_SEPARATOR = '|';

    /**
     * Symbol between Name and Value between Pairs.
     */
    const PAIR_NAME_VALUE_SEPARATOR = '=';

    /**
     * Value that means all entities (e.g. websites, groups etc.)
     */
    const VALUE_ALL = 'all';

    /**
     * Data row scopes.
     */
    const SCOPE_DEFAULT = 1;

    const SCOPE_WEBSITE = 2;

    const SCOPE_STORE = 0;

    const SCOPE_NULL = -1;

    /**
     * Permanent column names.
     *
     * Names that begins with underscore is not an attribute. This name convention is for
     * to avoid interference with same attribute name.
     */

    /**
     * Column product store.
     */
    const COL_STORE = '_store';

    /**
     * Column product store view code.
     */
    const COL_STORE_VIEW_CODE = 'store_view_code';

    /**
     * Column website.
     */
    const COL_WEBSITE = 'website_code';

    /**
     * Column product attribute set.
     */
    const COL_ATTR_SET = '_attribute_set';

    /**
     * Column product type.
     */
    const COL_TYPE = 'product_type';

    /**
     * Column product category.
     */
    const COL_CATEGORY = 'categories';

    /**
     * Column product visibility.
     */
    const COL_VISIBILITY = 'visibility';

    /**
     * Column product sku.
     */
    const COL_SKU = 'sku';

    /**
     * Column product name.
     */
    const COL_NAME = 'name';

    /**
     * Column product website.
     */
    const COL_PRODUCT_WEBSITES = '_product_websites';

    /**
     * Attribute code for media gallery.
     */
    const MEDIA_GALLERY_ATTRIBUTE_CODE = 'media_gallery';

    /**
     * Column media image.
     */
    const COL_MEDIA_IMAGE = '_media_image';

    /**
     * Inventory use config label.
     */
    const INVENTORY_USE_CONFIG = 'Use Config';

    /**
     * Prefix for inventory use config.
     */
    const INVENTORY_USE_CONFIG_PREFIX = 'use_config_';

    /**
     * Url key attribute code
     */
    const URL_KEY = 'url_key';
    /**
     * Check one attribute. Can be overridden in child.
     *
     * @param string $attrCode Attribute code
     * @param array $attrParams Attribute params
     * @param array $rowData Row data
     * @param int $rowNum
     * @return bool
     */
    public function isAttributeValid($attrCode, array $attrParams, array $rowData, $rowNum)
    {
        return true;
    }

    /**
     * Multiple value separator getter.
     *
     * @return string
     */
    public function getMultipleValueSeparator()
    {
        return Import::DEFAULT_GLOBAL_MULTI_VALUE_SEPARATOR;
    }

    /**
     * Return empty attribute value constant
     *
     * @return string
     * @since 101.0.0
     */
    public function getEmptyAttributeValueConstant()
    {
        return Import::DEFAULT_EMPTY_ATTRIBUTE_VALUE_CONSTANT;
    }

    /**
     * Retrieve instance of product custom options import entity
     *
     * @return \Magento\CatalogImportExport\Model\Import\Product\Option
     */
    public function getOptionEntity()
    {
        return false;
    }

    /**
     * Retrieve id of media gallery attribute.
     *
     * @return int
     */
    public function getMediaGalleryAttributeId()
    {
        return 0;
    }

    /**
     * Retrieve product type by name.
     *
     * @param string $name
     * @return Product\Type\AbstractType
     */
    public function retrieveProductTypeByName($name)
    {
        return null;
    }

    /**
     * Delete products for replacement.
     *
     * @return $this
     */
    public function deleteProductsForReplacement()
    {
        return $this;
    }

 
 
    /**
     * Update and insert data in entity table.
     *
     * @param array $entityRowsIn Row for insert
     * @param array $entityRowsUp Row for update
     * @return $this
     * @since 100.1.0
     */
    public function saveProductEntity(array $entityRowsIn, array $entityRowsUp)
    {
        return $this;
    }

    /**
     * Retrieve image from row.
     *
     * @param array $rowData
     * @return array
     */
    public function getImagesFromRow(array $rowData)
    {
        return [[], []];
    }


    /**
     * Retrieve product categories.
     *
     * @param string $productSku
     * @return array
     */
    public function getProductCategories($productSku)
    {
        return [];
    }
    
    /**
     * Get product websites.
     *
     * @param string $productSku
     * @return array
     */
    public function getProductWebsites($productSku)
    {
        return [];
    }

    /**
     * Get store id by code.
     *
     * @param string $storeCode
     * @return array|int|null|string
     */
    public function getStoreIdByCode($storeCode)
    {
        return self::SCOPE_DEFAULT;
    }

    /**
     * Retrieve attribute by code
     *
     * @param string $attrCode
     * @return mixed
     */
    public function retrieveAttributeByCode($attrCode)
    {
        return false;
    }

    /**
     * Attribute set ID-to-name pairs getter.
     *
     * @return array
     */
    public function getAttrSetIdToName()
    {
        return [];
    }

    /**
     * EAV entity type code getter.
     *
     * @abstract
     * @return string
     */
    public function getEntityTypeCode()
    {
        return 'catalog_product';
    }

    /**
     * New products SKU data.
     *
     * Returns array of new products data with SKU as key. All SKU keys are in lowercase for avoiding creation of
     * new products with the same SKU in different letter cases.
     *
     * @param string $sku
     * @return array
     */
    public function getNewSku($sku = null)
    {
        return [];
    }

    /**
     * Existing products SKU getter.
     *
     * Returns array of existing products data with SKU as key. All SKU keys are in lowercase for avoiding creation of
     * new products with the same SKU in different letter cases.
     *
     * @return array
     */
    public function getOldSku()
    {
        return [];
    }

    /**
     * Retrieve Category Processor
     *
     * @return \Magento\CatalogImportExport\Model\Import\Product\CategoryProcessor
     */
    public function getCategoryProcessor()
    {
        return false;
    }

    /**
     * Obtain scope of the row from row data.
     *
     * @param array $rowData
     * @return int
     */
    public function getRowScope(array $rowData)
    {
        if (empty($rowData[self::COL_STORE])) {
            return self::SCOPE_DEFAULT;
        }
        return self::SCOPE_STORE;
    }

    /**
     * Validate data row.
     *
     * @param array $rowData
     * @param int $rowNum
     * @return boolean
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @throws \Zend_Validate_Exception
     */
    public function validateRow(array $rowData, $rowNum)
    {
        return true;
    }
}
