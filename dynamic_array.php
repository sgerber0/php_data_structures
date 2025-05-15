<?php class Dynamic_Array {
    protected $dynamic_array; #The SplFixedArray
    protected $array_capacity; #The total size of the array
    protected $array_size; #The amount of non null items within the array
    protected $last_item_index; #The last non null item
    
    public function __construct() {
        $this->array_capacity = 1;
        $this->array_size = 0;
        $this->last_item_index = -1;
        $this->augment_array_size();
    }

    /* Adds a new item to the back of the array */
    /* Returns the index of the inserted item */

    public function push($item) {
        $this->insert(++$this->last_item_index,$item);
        return $this->last_item_index;
    }

    /* Returns that last non null item from the back of the array */

    public function pop() {
        return $this->remove($this->last_item_index--);
    }

    /* Updates value of array at specific index */
    /* Returns if index was valid */

    public function insert($index, $item) {
        if (0 <= $index) {
            if ($index > $this->last_item_index) {
                $this->last_item_index = $index;
            }
            if ($index >= $this->array_capacity - 1) {
                $this->augment_array_size();
            }
                    
            $this->dynamic_array[$index] = $item;
            $this->array_size++;
            return true;
        }
        return false;
    }


    /* Removes the element at the specified index */
    /* Returns if removal was within bounds */

    public function remove($index) {
        if (0 <= $index && $index < $this->array_capacity) {
            $this->dynamic_array[$index] = NULL;
            $this->array_size--;

            if ($index == $this->last_item_index) {
                $this->last_item_index =  $this->search_for_last_null();
            }
            if ($this->array_capacity/2 >= $this->last_item_index + 1) {
                $this->augment_array_size();
            }
            return true;
        }
        return false;
    }

    /* Returns the value at the specified index of the dynamic array */

    public function access($index) {
        return $this->dynamic_array[$index];
    }

    /* Returns last not null value */

    public function end() {
        return $this->dynamic_array[$this->last_item_index];
    }

    /* Returns the dynamic array as a php array object */

    public function get_array() {
        return $this->dynamic_array->toArray();
    }

    /* Returns if array is empty */

    public function is_empty() {
        return ($this->array_size === 0);
    }

    public function size() {
        return $this->array_size;
    }
    
    /* Helper function to find the last non null value in the array */
    private function search_for_last_null() {
        for ($i = $this->array_capacity - 1; $i >= 0; $i--) {
            if (!is_null($this->dynamic_array[$i])) {
                return $i;
            } 
        }
        return -1;
    }
 
    /* Helper function to change the size of the array */
    private function augment_array_size() {
        $this->array_capacity = ($this->last_item_index < 1)?1:2**ceil(log($this->last_item_index + 1, 2));
        $new_array = new SplFixedArray($this->array_capacity);
        for ($i = 0; $i < min(($this->dynamic_array)?count($this->dynamic_array):0, $this->array_capacity); $i++) {
            $new_array[$i] = $this->dynamic_array[$i];
        }
        $this->dynamic_array = $new_array;
    }
} ?>