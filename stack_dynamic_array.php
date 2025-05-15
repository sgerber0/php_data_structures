<?php include("dynamic_array.php");
class Dynamic_Stack extends Dynamic_Array {

    /* Supports */
    /* push, pop, peek, size, is_empty, get_array */

    public function peek() {
        if (!$this->is_empty()) {
            return $this->dynamic_array[$this->array_size - 1];
        }
   }

   public function push($item) {
        parent::push($item);
        return $this->array_size;
    }
}?>