<?php class Stack {
    protected $stack_array = array();
    protected $stack_size = 0;

    /* Adding a new item to the end of the stack */
    /* Returns new size of stack */

    public function push($item) {
        $this->stack_array[$this->stack_size] = $item;
            return ++$this->stack_size;
    }

    /* Removal of last element on the stack */
    /* Returns that last element */

    public function pop() {
        if ($this->stack_size) {
            $last_value = $this->stack_array[$this->stack_size - 1];
            $this->stack_array[--$this->stack_size] = NULL;
            return $last_value;
        }
    }

    /* Preview of last element on the stack */
    /* Returns the last element of the stack */

    public function peek() {
        if (!$this->is_empty()) {
            return $this->stack_array[$this->stack_size - 1];
        }
    }

    /* Returns number of element on the stack */

    public function size(): int {
        return $this->stack_size;
    }

    /* Return if stack is empty */

    public function is_empty(): bool {
        return ($this->stack_size === 0);
    }
    
    public function get_array() {
        return $this->stack_array;
    }
} ?>