<?php

// TODO: Create an abstract model/class for Record, can return an array of records, subclasses created for each type of report (Record should just be P21 Item)
//require_once('../database.php');
require_once('msdatabase.php');
require_once('Report.php');
class CriticalImportItemsReport extends Report {


    // constructor --> takes database object
    public function __construct(database $conn) {

        // get dbc object
        $this->dbc = $conn->getdbc();
    }

    // Abstract Method (must be defined)
    //run the report, pull data into Report object properties
    // returns result object

    public function run() {

        $sql = "select distinct im.item_id, im.item_desc, il.qty_on_hand, il.qty_allocated, (il.qty_on_hand - il.qty_allocated) as totalAvail, im.base_unit, s.supplier_name, iss.supplier_id, isl.primary_supplier from inv_mast im
inner join inv_loc il on im.inv_mast_uid = il.inv_mast_uid
inner join inventory_supplier iss on iss.inv_mast_uid = im.inv_mast_uid
inner join supplier s on iss.supplier_id = s.supplier_id
inner join inventory_supplier_x_loc isl on isl.inventory_supplier_uid = iss.inventory_supplier_uid
where (il.purchase_class = 'IT' or il.purchase_class = 'SP') and il.stockable = 'Y' and il.location_id = '100'  and isl.primary_supplier = 'Y' and il.qty_on_hand - il.qty_allocated < 100 and il.qty_on_hand - il.qty_allocated < il.inv_min
ORDER BY s.supplier_name
";
        $this->stmt = $this->dbc->query($sql);

        return $this->stmt;

       
    }

   
}
?>
