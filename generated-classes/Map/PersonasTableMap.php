<?php

namespace Map;

use \Personas;
use \PersonasQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'personas' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PersonasTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.PersonasTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'inmobiliaria';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'personas';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Personas';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Personas';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the id field
     */
    const COL_ID = 'personas.id';

    /**
     * the column name for the nombre field
     */
    const COL_NOMBRE = 'personas.nombre';

    /**
     * the column name for the apellido field
     */
    const COL_APELLIDO = 'personas.apellido';

    /**
     * the column name for the identificacion field
     */
    const COL_IDENTIFICACION = 'personas.identificacion';

    /**
     * the column name for the correoelectronico field
     */
    const COL_CORREOELECTRONICO = 'personas.correoelectronico';

    /**
     * the column name for the id_usuario field
     */
    const COL_ID_USUARIO = 'personas.id_usuario';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Nombre', 'Apellido', 'Identificacion', 'Correoelectronico', 'IdUsuario', ),
        self::TYPE_CAMELNAME     => array('id', 'nombre', 'apellido', 'identificacion', 'correoelectronico', 'idUsuario', ),
        self::TYPE_COLNAME       => array(PersonasTableMap::COL_ID, PersonasTableMap::COL_NOMBRE, PersonasTableMap::COL_APELLIDO, PersonasTableMap::COL_IDENTIFICACION, PersonasTableMap::COL_CORREOELECTRONICO, PersonasTableMap::COL_ID_USUARIO, ),
        self::TYPE_FIELDNAME     => array('id', 'nombre', 'apellido', 'identificacion', 'correoelectronico', 'id_usuario', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Nombre' => 1, 'Apellido' => 2, 'Identificacion' => 3, 'Correoelectronico' => 4, 'IdUsuario' => 5, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'nombre' => 1, 'apellido' => 2, 'identificacion' => 3, 'correoelectronico' => 4, 'idUsuario' => 5, ),
        self::TYPE_COLNAME       => array(PersonasTableMap::COL_ID => 0, PersonasTableMap::COL_NOMBRE => 1, PersonasTableMap::COL_APELLIDO => 2, PersonasTableMap::COL_IDENTIFICACION => 3, PersonasTableMap::COL_CORREOELECTRONICO => 4, PersonasTableMap::COL_ID_USUARIO => 5, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'nombre' => 1, 'apellido' => 2, 'identificacion' => 3, 'correoelectronico' => 4, 'id_usuario' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('personas');
        $this->setPhpName('Personas');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Personas');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('nombre', 'Nombre', 'VARCHAR', true, 20, null);
        $this->addColumn('apellido', 'Apellido', 'VARCHAR', true, 20, null);
        $this->addColumn('identificacion', 'Identificacion', 'VARCHAR', true, 20, null);
        $this->addColumn('correoelectronico', 'Correoelectronico', 'VARCHAR', true, 20, null);
        $this->addForeignKey('id_usuario', 'IdUsuario', 'INTEGER', 'usuarios', 'id', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Usuarios', '\\Usuarios', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_usuario',
    1 => ':id',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? PersonasTableMap::CLASS_DEFAULT : PersonasTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Personas object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PersonasTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PersonasTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PersonasTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PersonasTableMap::OM_CLASS;
            /** @var Personas $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PersonasTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = PersonasTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PersonasTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Personas $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PersonasTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(PersonasTableMap::COL_ID);
            $criteria->addSelectColumn(PersonasTableMap::COL_NOMBRE);
            $criteria->addSelectColumn(PersonasTableMap::COL_APELLIDO);
            $criteria->addSelectColumn(PersonasTableMap::COL_IDENTIFICACION);
            $criteria->addSelectColumn(PersonasTableMap::COL_CORREOELECTRONICO);
            $criteria->addSelectColumn(PersonasTableMap::COL_ID_USUARIO);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.nombre');
            $criteria->addSelectColumn($alias . '.apellido');
            $criteria->addSelectColumn($alias . '.identificacion');
            $criteria->addSelectColumn($alias . '.correoelectronico');
            $criteria->addSelectColumn($alias . '.id_usuario');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(PersonasTableMap::DATABASE_NAME)->getTable(PersonasTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PersonasTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PersonasTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PersonasTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Personas or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Personas object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersonasTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Personas) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PersonasTableMap::DATABASE_NAME);
            $criteria->add(PersonasTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = PersonasQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PersonasTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PersonasTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the personas table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PersonasQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Personas or Criteria object.
     *
     * @param mixed               $criteria Criteria or Personas object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersonasTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Personas object
        }

        if ($criteria->containsKey(PersonasTableMap::COL_ID) && $criteria->keyContainsValue(PersonasTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PersonasTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = PersonasQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PersonasTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PersonasTableMap::buildTableMap();
