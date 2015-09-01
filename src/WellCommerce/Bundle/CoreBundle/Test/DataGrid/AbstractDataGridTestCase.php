<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 * 
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 * 
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace WellCommerce\Bundle\CoreBundle\Test\DataGrid;

use WellCommerce\Bundle\CoreBundle\Test\AbstractTestCase;
use WellCommerce\Bundle\DataGridBundle\Column\Column;

/**
 * Class AbstractDataGridTestCase
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
abstract class AbstractDataGridTestCase extends AbstractTestCase
{
    /**
     * @return null|\WellCommerce\Bundle\DataGridBundle\DataGridInterface
     */
    protected function get()
    {
        return null;
    }

    /**
     * @return array
     */
    protected function getColumns()
    {
        return [];
    }

    public function testDatagridServiceIsCreated()
    {
        $datagrid = $this->get();

        if (null !== $datagrid) {
            $this->assertInstanceOf('WellCommerce\Bundle\DataGridBundle\DataGridInterface', $datagrid);
        }
    }

    public function testDatagridColumnsCollectionIsConfigurable()
    {
        $datagrid = $this->get();

        if (null !== $datagrid) {
            $columns       = $datagrid->getColumns();
            $previousCount = $columns->count();
            $newCount      = rand(1, 10);

            for ($i = 0; $i < $newCount; $i++) {
                $columns->add(new Column([
                    'id'      => 'new_column_' . $i,
                    'caption' => '',
                ]));
            }

            $this->assertInstanceOf('WellCommerce\Bundle\DataGridBundle\Column\ColumnCollection', $columns);
            $this->assertCount($previousCount + $newCount, $columns);
        }
    }

    public function testDatagridHasRequiredColumns()
    {
        $datagrid = $this->get();

        if (null !== $datagrid) {
            $columns         = $datagrid->getColumns();
            $requiredColumns = $this->getColumns();

            foreach ($requiredColumns as $identifier) {
                /**
                 * @var $column \WellCommerce\Bundle\DataGridBundle\Column\ColumnInterface
                 */
                $column = $columns->get($identifier);
                $this->assertInstanceOf('WellCommerce\Bundle\DataGridBundle\Column\ColumnInterface', $column);
                $this->assertEquals($identifier, $column->getId());
            }
        }
    }
}
