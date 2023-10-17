<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Response;

    /**
     * Class ResponseItems
     * @package smallinvoice\api2\Wrapper\Response
     */
    class ResponseItems implements \Iterator, \Countable
    {

        /**
         * Iterator index
         * @var int
         */
        private $index;

        /**
         * Items array
         * @var \stdClass[]
         */
        private $items;

        /**
         * Number of items
         * @var int
         */
        private $total;

        /**
         * Current page
         * @var int
         */
        private $page;

        /**
         * Number of pages
         * @var int
         */
        private $pages;

        /**
         * URL to first page
         * @var string
         */
        private $urlFirst;

        /**
         * URL to last page
         * @var string
         */
        private $urlLast;

        /**
         * URL to next page (if existing)
         * @var string
         */
        private $urlNext;

        /**
         * URL to previous page (if existing)
         * @var string
         */
        private $urlPrevious;

        /**
         * ResponseItems constructor.
         * @param array $items
         * @param \stdClass $pagination
         */
        public function __construct(array $items, \stdClass $pagination)
        {
            $this->index = 0;
            $this->items = $items;
            $this->total = (int)$pagination->total;
            $this->page = (int)$pagination->page;
            $this->pages = (int)$pagination->pages;
            $this->urlFirst = (string)$pagination->first;
            $this->urlLast = (string)$pagination->last;
            if (property_exists($pagination, 'next')) {
                $this->urlNext = (string)$pagination->next;
            }
            if (property_exists($pagination, 'previous')) {
                $this->urlPrevious = (string)$pagination->previous;
            }
        }

        /**
         * Creates ResponseItems object from Response
         * @param Response $response
         * @return ResponseItems
         * @throws ResponseException
         */
        public static function createFromResponse(Response $response): ResponseItems
        {
            $parsedResponseBody = $response->getParsedBody();
            if (!property_exists($parsedResponseBody, 'items')) {
                throw new ResponseException('Property item not set');
            }

            if (!property_exists($parsedResponseBody, 'pagination')) {
                throw new ResponseException('Property pagination not set');
            }

            return new static($parsedResponseBody->items, $parsedResponseBody->pagination);
        }

        /**
         * Return the current element
         * @link http://php.net/manual/en/iterator.current.php
         * @return mixed Can return any type.
         * @since 5.0.0
         */
        public function current()
        {
            return $this->valid() ? new ResponseItem($this->items[$this->index]) : null;
        }

        /**
         * Move forward to next element
         * @link http://php.net/manual/en/iterator.next.php
         * @return void Any returned value is ignored.
         * @since 5.0.0
         */
        public function next()
        {
            ++$this->index;
        }

        /**
         * Return the key of the current element
         * @link http://php.net/manual/en/iterator.key.php
         * @return mixed scalar on success, or null on failure.
         * @since 5.0.0
         */
        public function key()
        {
            return $this->index;
        }

        /**
         * Checks if current position is valid
         * @link http://php.net/manual/en/iterator.valid.php
         * @return boolean The return value will be casted to boolean and then evaluated.
         * Returns true on success or false on failure.
         * @since 5.0.0
         */
        public function valid()
        {
            return isset($this->items[$this->index]);
        }

        /**
         * Rewind the Iterator to the first element
         * @link http://php.net/manual/en/iterator.rewind.php
         * @return void Any returned value is ignored.
         * @since 5.0.0
         */
        public function rewind()
        {
            $this->index = 0;
        }

        /**
         * Count elements of an object
         * @link http://php.net/manual/en/countable.count.php
         * @return int The custom count as an integer.
         * </p>
         * <p>
         * The return value is cast to an integer.
         * @since 5.1.0
         */
        public function count()
        {
            return count($this->items);
        }

        /**
         * Returns items values as an array
         * @return array
         */
        public function getAsArray(): array
        {
            $itemsArray = [];
            foreach ($this->items as $item) {
                $itemsArray[] = \GuzzleHttp\json_decode(\GuzzleHttp\json_encode($item), true);
            }

            return $itemsArray;
        }

        /**
         * Gets number of items
         * @return int
         */
        public function getTotal(): int
        {
            return $this->total;
        }

        /**
         * Gets current page number
         * @return int
         */
        public function getPage(): int
        {
            return $this->page;
        }

        /**
         * Gets number of pages
         * @return int
         */
        public function getPages(): int
        {
            return $this->pages;
        }

        /**
         * Gets URL to first page
         * @return string
         */
        public function getUrlFirst(): string
        {
            return $this->urlFirst;
        }

        /**
         * Gets URL to last page
         * @return string
         */
        public function getUrlLast(): string
        {
            return $this->urlLast;
        }

        /**
         * Gets URL to next page
         * @return string|null
         */
        public function getUrlNext()
        {
            return $this->urlNext;
        }

        /**
         * Gets URL to previous page
         * @return string|null
         */
        public function getUrlPrevious()
        {
            return $this->urlPrevious;
        }

        /**
         * Checks if next page exists
         * @return bool
         */
        public function hasNext(): bool
        {
            return !is_null($this->urlNext);
        }

        /**
         * Checks if previous page exists
         * @return bool
         */
        public function hasPrevious(): bool
        {
            return !is_null($this->urlPrevious);
        }

        /**
         * Checks if object contains specified item
         * @param ResponseItem $searchedItem
         * @return bool
         */
        public function containsItem(ResponseItem $searchedItem): bool
        {
            foreach ($this as $item) {
                if ($searchedItem->isEqual($item)) {
                    return true;
                }
            }

            return false;
        }
    }