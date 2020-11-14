<?php
namespace Application\Model;

use Application\Model\Tables\AbstractModel;
use Zend\Cache\StorageFactory;
//use DivixUtils\Zend\Paginator\Paginator as CustomPaginator;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;

class AbstractTable {
	protected $tableGateway;
	protected static $paginatorCache;

	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway = $tableGateway;

		if (empty(self::$paginatorCache)) {
			// ustawiamy cache o typie plików tekstowych w katalogu data/cache oraz
			// stosujemy konwersję seliazierow'ą do przechowywania danych
			// nasza kopia zostanie usunięta po 10 minutach (600 sekund)
			self::$paginatorCache = StorageFactory::factory([
				'adapter' => [
					'name' => 'filesystem',
					'options' => [
						'cache_dir' => 'data/cache',
						'ttl' => 600,
					],
				],
				'plugins' => ['serializer'],
			]);
			CustomPaginator::setCache(self::$paginatorCache);
		}
	}

	public function saveRow(AbstractModel $userModel, $data = null) {
		$id = $userModel->getId();

		//jeśli parametr $data nie jest przekazany wtedy zaktualizujemy wszystkie właściwości
		if (empty($data)) {
			$data = $userModel->getArrayCopy();
		}
		if (empty($id)) {
			$this->tableGateway->insert($data);

			return $this->tableGateway->getLastInsertValue();
		}
		if (!$this->getById($id)) {
			throw new RuntimeException(get_class($userModel) . ' with id: ' . $id . ' not found');
		}

		$this->tableGateway->update($data, ['id' => $id]);
		return $id;
	}

	public function deleteRow($id) {
		$this->tableGateway->delete(['id' => (int) $id]);
	}

	public function getTableGateway() {
		return $this->tableGateway;
	}

	protected function fetchAll($select, array $paginateOptions = null) {
		if (!empty($paginateOptions)) {
			//stwórzmy najpierw adapter, który przekażemy do Paginatora
			$paginatorAdapter = new DbSelect(
				$select,
				$this->tableGateway->getAdapter(),
				$this->tableGateway->getResultSetPrototype()
			);
			$paginator = new CustomPaginator($paginatorAdapter);
			//ustawiamy ilość rekordów na stronie
			$paginator->setItemCountPerPage($paginateOptions['limit']);

			//jeśli przekazany jest parametr page, wtedy ustawiamy offset dla wyników
			if (isset($paginateOptions['page'])) {
				$paginator->setCurrentPageNumber($paginateOptions['page']);
			}

			return $paginator;
		}

		return $this->tableGateway->selectWith($select);
	}

	protected function fetchRow($passedSelect) {
		$row = $this->tableGateway->selectWith($passedSelect);

		return $row->current();
	}
}