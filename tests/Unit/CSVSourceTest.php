<?php

use DivineOmega\uxdm\Objects\Sources\CSVSource;
use PHPUnit\Framework\TestCase;

final class CSVSourceTest extends TestCase
{
    private function createSource()
    {
        return new CSVSource(__DIR__.'/Data/source.csv');
    }

    private function createSourceWithPerPage($numberOfPages)
    {
        return new CSVSource(__DIR__.'/Data/source.csv', $numberOfPages);
    }

    public function testGetFields()
    {
        $source = $this->createSource();

        $this->assertEquals(['Title', 'Author'], $source->getFields());
    }

    public function testGetDataRows()
    {
        $source = $this->createSource();

        $dataRows = $source->getDataRows(1, ['Title', 'Author']);

        $this->assertCount(6, $dataRows);

        $dataItems = $dataRows[0]->getDataItems();

        $this->assertCount(2, $dataItems);

        $this->assertEquals('Title', $dataItems[0]->fieldName);
        $this->assertEquals('Adventures Of Me', $dataItems[0]->value);

        $this->assertEquals('Author', $dataItems[1]->fieldName);
        $this->assertEquals('Jordan Hall', $dataItems[1]->value);

        $dataItems = $dataRows[1]->getDataItems();

        $this->assertCount(2, $dataItems);

        $this->assertEquals('Title', $dataItems[0]->fieldName);
        $this->assertEquals('All The Things', $dataItems[0]->value);

        $this->assertEquals('Author', $dataItems[1]->fieldName);
        $this->assertEquals('Mr Bear', $dataItems[1]->value);

        $dataItems = $dataRows[2]->getDataItems();

        $this->assertCount(2, $dataItems);

        $this->assertEquals('Title', $dataItems[0]->fieldName);
        $this->assertEquals('More Things', $dataItems[0]->value);

        $this->assertEquals('Author', $dataItems[1]->fieldName);
        $this->assertEquals('To Add More Pages', $dataItems[1]->value);

        $dataItems = $dataRows[3]->getDataItems();

        $this->assertCount(2, $dataItems);

        $this->assertEquals('Title', $dataItems[0]->fieldName);
        $this->assertEquals('Even More Things', $dataItems[0]->value);

        $this->assertEquals('Author', $dataItems[1]->fieldName);
        $this->assertEquals('To Add Even More Pages', $dataItems[1]->value);

        $dataItems = $dataRows[4]->getDataItems();

        $this->assertCount(2, $dataItems);

        $this->assertEquals('Title', $dataItems[0]->fieldName);
        $this->assertEquals('The First Of Two More Things', $dataItems[0]->value);

        $this->assertEquals('Author', $dataItems[1]->fieldName);
        $this->assertEquals('To Add A Final Page', $dataItems[1]->value);

        $dataItems = $dataRows[5]->getDataItems();

        $this->assertCount(2, $dataItems);

        $this->assertEquals('Title', $dataItems[0]->fieldName);
        $this->assertEquals('The Second Of Two More Things', $dataItems[0]->value);

        $this->assertEquals('Author', $dataItems[1]->fieldName);
        $this->assertEquals('To Complete A Final Page', $dataItems[1]->value);

        $dataRows = $source->getDataRows(2, ['Title', 'Author']);

        $this->assertCount(0, $dataRows);
    }

    public function testGetDataRowsOnlyOneField()
    {
        $source = $this->createSource();

        $dataRows = $source->getDataRows(1, ['Author']);

        $this->assertCount(6, $dataRows);

        $dataItems = $dataRows[0]->getDataItems();

        $this->assertCount(1, $dataItems);

        $this->assertEquals('Author', $dataItems[0]->fieldName);
        $this->assertEquals('Jordan Hall', $dataItems[0]->value);

        $dataItems = $dataRows[1]->getDataItems();

        $this->assertCount(1, $dataItems);

        $this->assertEquals('Author', $dataItems[0]->fieldName);
        $this->assertEquals('Mr Bear', $dataItems[0]->value);

        $dataItems = $dataRows[2]->getDataItems();

        $this->assertCount(1, $dataItems);

        $this->assertEquals('Author', $dataItems[0]->fieldName);
        $this->assertEquals('To Add More Pages', $dataItems[0]->value);

        $dataItems = $dataRows[3]->getDataItems();

        $this->assertCount(1, $dataItems);

        $this->assertEquals('Author', $dataItems[0]->fieldName);
        $this->assertEquals('To Add Even More Pages', $dataItems[0]->value);

        $dataItems = $dataRows[4]->getDataItems();

        $this->assertCount(1, $dataItems);

        $this->assertEquals('Author', $dataItems[0]->fieldName);
        $this->assertEquals('To Add A Final Page', $dataItems[0]->value);

        $dataItems = $dataRows[5]->getDataItems();

        $this->assertCount(1, $dataItems);

        $this->assertEquals('Author', $dataItems[0]->fieldName);
        $this->assertEquals('To Complete A Final Page', $dataItems[0]->value);

        $dataRows = $source->getDataRows(2, ['Author']);

        $this->assertCount(0, $dataRows);
    }

    public function testCountDataRows()
    {
        $source = $this->createSource();

        $this->assertEquals(6, $source->countDataRows());
    }

    public function testCountPages()
    {
        $source = $this->createSource();

        $this->assertEquals(1, $source->countPages());
    }

    public function testCountPagesWithUnevenlyRoundingOverride()
    {
        $source = $this->createSourceWithPerPage(4);

        $this->assertEquals(2, $source->countPages());
    }

    public function testCountPagesWithEvenlyRoundingOverride()
    {
        $source = $this->createSourceWithPerPage(2);

        $this->assertEquals(3, $source->countPages());
    }

    public function testGetDataRowsWithUnevenlyRoundingOverride()
    {
        $source = $this->createSourceWithPerPage(4);

        $dataRows = $source->getDataRows(1, ['Title', 'Author']);

        $this->assertCount(4, $dataRows);

        $dataItems = $dataRows[0]->getDataItems();

        $this->assertCount(2, $dataItems);

        $this->assertEquals('Title', $dataItems[0]->fieldName);
        $this->assertEquals('Adventures Of Me', $dataItems[0]->value);

        $this->assertEquals('Author', $dataItems[1]->fieldName);
        $this->assertEquals('Jordan Hall', $dataItems[1]->value);

        $dataItems = $dataRows[1]->getDataItems();

        $this->assertCount(2, $dataItems);

        $this->assertEquals('Title', $dataItems[0]->fieldName);
        $this->assertEquals('All The Things', $dataItems[0]->value);

        $this->assertEquals('Author', $dataItems[1]->fieldName);
        $this->assertEquals('Mr Bear', $dataItems[1]->value);

        $dataItems = $dataRows[2]->getDataItems();

        $this->assertCount(2, $dataItems);

        $this->assertEquals('Title', $dataItems[0]->fieldName);
        $this->assertEquals('More Things', $dataItems[0]->value);

        $this->assertEquals('Author', $dataItems[1]->fieldName);
        $this->assertEquals('To Add More Pages', $dataItems[1]->value);

        $dataItems = $dataRows[3]->getDataItems();

        $this->assertCount(2, $dataItems);

        $this->assertEquals('Title', $dataItems[0]->fieldName);
        $this->assertEquals('Even More Things', $dataItems[0]->value);

        $this->assertEquals('Author', $dataItems[1]->fieldName);
        $this->assertEquals('To Add Even More Pages', $dataItems[1]->value);

        $dataRows = $source->getDataRows(2, ['Title', 'Author']);

        $this->assertCount(2, $dataRows);

        $dataItems = $dataRows[0]->getDataItems();

        $this->assertCount(2, $dataItems);

        $this->assertEquals('Title', $dataItems[0]->fieldName);
        $this->assertEquals('The First Of Two More Things', $dataItems[0]->value);

        $this->assertEquals('Author', $dataItems[1]->fieldName);
        $this->assertEquals('To Add A Final Page', $dataItems[1]->value);

        $dataItems = $dataRows[1]->getDataItems();

        $this->assertCount(2, $dataItems);

        $this->assertEquals('Title', $dataItems[0]->fieldName);
        $this->assertEquals('The Second Of Two More Things', $dataItems[0]->value);

        $this->assertEquals('Author', $dataItems[1]->fieldName);
        $this->assertEquals('To Complete A Final Page', $dataItems[1]->value);

        $dataRows = $source->getDataRows(3, ['Title', 'Author']);

        $this->assertCount(0, $dataRows);
    }

    public function testGetDataRowsWithEvenlyRoundingOverride()
    {
        $source = $this->createSourceWithPerPage(2);

        $dataRows = $source->getDataRows(1, ['Title', 'Author']);

        $this->assertCount(2, $dataRows);

        $dataItems = $dataRows[0]->getDataItems();

        $this->assertCount(2, $dataItems);

        $this->assertEquals('Title', $dataItems[0]->fieldName);
        $this->assertEquals('Adventures Of Me', $dataItems[0]->value);

        $this->assertEquals('Author', $dataItems[1]->fieldName);
        $this->assertEquals('Jordan Hall', $dataItems[1]->value);

        $dataItems = $dataRows[1]->getDataItems();

        $this->assertCount(2, $dataItems);

        $this->assertEquals('Title', $dataItems[0]->fieldName);
        $this->assertEquals('All The Things', $dataItems[0]->value);

        $this->assertEquals('Author', $dataItems[1]->fieldName);
        $this->assertEquals('Mr Bear', $dataItems[1]->value);

        $dataRows = $source->getDataRows(2, ['Title', 'Author']);

        $this->assertCount(2, $dataRows);

        $dataItems = $dataRows[0]->getDataItems();

        $this->assertCount(2, $dataItems);

        $this->assertEquals('Title', $dataItems[0]->fieldName);
        $this->assertEquals('More Things', $dataItems[0]->value);

        $this->assertEquals('Author', $dataItems[1]->fieldName);
        $this->assertEquals('To Add More Pages', $dataItems[1]->value);

        $dataItems = $dataRows[1]->getDataItems();

        $this->assertCount(2, $dataItems);

        $this->assertEquals('Title', $dataItems[0]->fieldName);
        $this->assertEquals('Even More Things', $dataItems[0]->value);

        $this->assertEquals('Author', $dataItems[1]->fieldName);
        $this->assertEquals('To Add Even More Pages', $dataItems[1]->value);

        $dataRows = $source->getDataRows(3, ['Title', 'Author']);

        $this->assertCount(2, $dataRows);

        $dataItems = $dataRows[0]->getDataItems();

        $this->assertCount(2, $dataItems);

        $this->assertEquals('Title', $dataItems[0]->fieldName);
        $this->assertEquals('The First Of Two More Things', $dataItems[0]->value);

        $this->assertEquals('Author', $dataItems[1]->fieldName);
        $this->assertEquals('To Add A Final Page', $dataItems[1]->value);

        $dataItems = $dataRows[1]->getDataItems();

        $this->assertCount(2, $dataItems);

        $this->assertEquals('Title', $dataItems[0]->fieldName);
        $this->assertEquals('The Second Of Two More Things', $dataItems[0]->value);

        $this->assertEquals('Author', $dataItems[1]->fieldName);
        $this->assertEquals('To Complete A Final Page', $dataItems[1]->value);

        $dataRows = $source->getDataRows(4, ['Title', 'Author']);

        $this->assertCount(0, $dataRows);
    }
}
