<?php

// TODO: Create an abstract model/class for Record, can return an array of records, subclasses created for each type of report (Record should just be P21 Item)
//require_once('../database.php');
require_once 'msdatabase.php';
require_once 'Report.php';
class BackerboardReport extends Report
{

    private $perma12usage = 0;
    private $perma14usage = 0;
    private $hardi12usage = 0;
    private $hardi14usage = 0;

    private $perma12stock = 0;
    private $perma14stock = 0;
    private $hardi12stock = 0;
    private $hardi14stock = 0;

    private $thisyear;
    private $lastyear;

    // constructor --> takes database object
    public function __construct(database $conn)
    {

        // get dbc object
        $this->dbc = $conn->getdbc();


        // set current 12mo periods
        $this->thisyear =  date("Y") . "-" . date("m") . "-01";
        $this->lastyear  =  date("Y")-1 . "-" . date("m") . "-01";

    }

    // Abstract Method (must be defined)
    // run the report, pull data into Report object properties
    // returns result object

    public function runPerma12()
    {


        $sql = "Declare @userend2 date
Declare @userstart2 date

Set @userend2 = '$this->thisyear'
Set @userstart2 = '$this->lastyear'

Declare @userend varchar(30)
Declare @userstart varchar(30)
Declare @supplierID varchar(30)

Set @userend = substring(convert(varchar,@userend2),1,4) + substring(convert(varchar,@userend2),6,2)
Set @userstart = substring(convert(varchar,@userstart2),1,4) + substring(convert(varchar,@userstart2),6,2)

Declare @NumPeriods as int

set @NumPeriods = Iif(CONVERT(INT,(substring(@userstart,1,4))) < CONVERT(INT,(substring(@userend,1,4))),
(13 - CONVERT(INT,(substring(@userstart,5,2)))) + CONVERT(INT,(substring(@userend,5,2))),
CONVERT(INT,(substring(@userend,5,2))) - CONVERT(INT,(substring(@userstart,5,2))) + 1)


SELECT final.item_id, final.item_desc,(sum(totalCalcUsage)/@NumPeriods) as final_calc_usage, sum(final.total_avail) as total_available

from


(
select finaltotal.item_id, finaltotal.item_desc,sum(finaltotal.usage) as totalCalcUsage, sum(finaltotal.number_of_orders) as total_number_of_orders,
finaltotal.qty_in_process, finaltotal.qty_in_transit, finaltotal.order_quantity, finaltotal.total_avail

from

(
SELECT

aaaraw.item_id, aaaraw.item_desc, aaaraw.location_id, demand_period.computed_year_period, aaaraw.demand_period_uid, sum(aaaraw.inv_period_usage) as usage, sum(aaaraw.number_of_orders) as number_of_orders,
aaaraw.qty_in_process, aaaraw.qty_in_transit, aaaraw.order_quantity, ((aaaraw.qty_on_hand + aaaraw.order_quantity + aaaraw.qty_in_transit) - (aaaraw.qty_allocated + aaaraw.qty_backordered)) as total_avail

FROM

(
SELECT dbo.inv_mast.inv_mast_uid,
dbo.inv_mast.item_id,
dbo.inv_mast.item_desc,
dbo.inv_loc.product_group_id,
dbo.inv_loc.location_id,
dbo.inv_loc.primary_supplier_id,
dbo.inv_loc.inv_min,
dbo.inv_loc.inv_max,
dbo.inv_period_usage.number_of_orders,
dbo.inv_loc.stockable,
IsNull(inv_period_usage,0) AS inv_period_usage,


IsNull(dbo.inv_period_usage.demand_period_uid,


	(case when convert(int,left(@userend,4)) > '2016'
		then @userend - (199999 + 88*(convert(int,left(@userend,4))-2000))
		ELSE
		@userend - (200000 + (88*(convert(int,left(@userend,4))- 2000)))
		end


)) as demand_period_uid,


dbo.inv_loc.qty_on_hand,
dbo.inv_loc.qty_in_process,
dbo.inv_loc.qty_allocated,
dbo.inv_loc.qty_backordered,
dbo.inv_loc.qty_in_transit,
dbo.inv_loc.order_quantity
FROM dbo.inv_mast

	LEFT JOIN dbo.inv_loc ON dbo.inv_mast.inv_mast_uid = dbo.inv_loc.inv_mast_uid
	LEFT JOIN dbo.inv_period_usage ON dbo.inv_mast.inv_mast_uid = dbo.inv_period_usage.inv_mast_uid and dbo.inv_loc.location_id = dbo.inv_period_usage.location_id


WHERE  inv_mast.item_id = 'CB3612'
	) aaaraw



LEFT JOIN dbo.demand_period ON aaaraw.demand_period_uid = demand_period.demand_period_uid
WHERE (computed_year_period between @userstart and @userend)

group by aaaraw.item_id, aaaraw.item_desc, aaaraw.qty_on_hand, aaaraw.qty_allocated, aaaraw.qty_backordered, aaaraw.qty_in_process, aaaraw.qty_in_transit, aaaraw.order_quantity, demand_period.computed_year_period,
aaaraw.location_id, aaaraw.inv_period_usage, aaaraw.demand_period_uid  ) as finaltotal

group by finaltotal.item_id, finaltotal.item_desc,finaltotal.qty_in_process, finaltotal.qty_in_transit, finaltotal.order_quantity, finaltotal.total_avail ) as final


group by final.item_id, final.item_desc
order by final.item_id


";

        $this->stmt = $this->dbc->query($sql);

        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);

        $this->perma12usage = round($row['final_calc_usage'],2);
        $this->perma12stock = round($row['total_available'],2);

    }

    public function runPerma14()
    {

        $sql = "Declare @userend2 date
Declare @userstart2 date

Set @userend2 = '2019-02-01'
Set @userstart2 = '2018-02-01'

Declare @userend varchar(30)
Declare @userstart varchar(30)
Declare @supplierID varchar(30)

Set @userend = substring(convert(varchar,@userend2),1,4) + substring(convert(varchar,@userend2),6,2)/*'201712'*/
Set @userstart = substring(convert(varchar,@userstart2),1,4) + substring(convert(varchar,@userstart2),6,2)/*'201706' */

Declare @NumPeriods as int

set @NumPeriods = Iif(CONVERT(INT,(substring(@userstart,1,4))) < CONVERT(INT,(substring(@userend,1,4))),
(13 - CONVERT(INT,(substring(@userstart,5,2)))) + CONVERT(INT,(substring(@userend,5,2))),
CONVERT(INT,(substring(@userend,5,2))) - CONVERT(INT,(substring(@userstart,5,2))) + 1)

/*FINAL TOTALS*****************************************************************************************/
SELECT final.item_id, final.item_desc,(sum(totalCalcUsage)/@NumPeriods) as final_calc_usage, sum(final.total_avail) as total_available

from

/*TOTALS*****************************************************************************************/
(
select finaltotal.item_id, finaltotal.item_desc,sum(finaltotal.usage) as totalCalcUsage, sum(finaltotal.number_of_orders) as total_number_of_orders,
finaltotal.qty_in_process, finaltotal.qty_in_transit, finaltotal.order_quantity, finaltotal.total_avail

from

(
SELECT

aaaraw.item_id, aaaraw.item_desc, aaaraw.location_id, demand_period.computed_year_period, aaaraw.demand_period_uid, sum(aaaraw.inv_period_usage) as usage, sum(aaaraw.number_of_orders) as number_of_orders,
aaaraw.qty_in_process, aaaraw.qty_in_transit, aaaraw.order_quantity, ((aaaraw.qty_on_hand + aaaraw.order_quantity + aaaraw.qty_in_transit) - (aaaraw.qty_allocated + aaaraw.qty_backordered)) as total_avail

FROM

(
SELECT dbo.inv_mast.inv_mast_uid,
dbo.inv_mast.item_id,
dbo.inv_mast.item_desc,
dbo.inv_loc.product_group_id,
dbo.inv_loc.location_id,
dbo.inv_loc.primary_supplier_id,
dbo.inv_loc.inv_min,
dbo.inv_loc.inv_max,
dbo.inv_period_usage.number_of_orders,
dbo.inv_loc.stockable,
IsNull(inv_period_usage,0) AS inv_period_usage,


IsNull(dbo.inv_period_usage.demand_period_uid,


	(case when convert(int,left(@userend,4)) > '2016'
		then @userend - (199999 + 88*(convert(int,left(@userend,4))-2000))
		ELSE
		@userend - (200000 + (88*(convert(int,left(@userend,4))- 2000)))
		end


)) as demand_period_uid,


dbo.inv_loc.qty_on_hand,
dbo.inv_loc.qty_in_process,
dbo.inv_loc.qty_allocated,
dbo.inv_loc.qty_backordered,
dbo.inv_loc.qty_in_transit,
dbo.inv_loc.order_quantity
FROM dbo.inv_mast

	LEFT JOIN dbo.inv_loc ON dbo.inv_mast.inv_mast_uid = dbo.inv_loc.inv_mast_uid
	LEFT JOIN dbo.inv_period_usage ON dbo.inv_mast.inv_mast_uid = dbo.inv_period_usage.inv_mast_uid and dbo.inv_loc.location_id = dbo.inv_period_usage.location_id


WHERE  inv_loc.stockable = 'Y' and inv_loc.delete_flag = 'N' and inv_loc.discontinued = 'N' and dbo.inv_mast.item_id = 'CB2314'
	) aaaraw



LEFT JOIN dbo.demand_period ON aaaraw.demand_period_uid = demand_period.demand_period_uid
WHERE (computed_year_period between @userstart and @userend)

group by aaaraw.item_id, aaaraw.item_desc, aaaraw.qty_on_hand, aaaraw.qty_allocated, aaaraw.qty_backordered, aaaraw.qty_in_process, aaaraw.qty_in_transit, aaaraw.order_quantity, demand_period.computed_year_period,
aaaraw.location_id, aaaraw.inv_period_usage, aaaraw.demand_period_uid  ) as finaltotal

group by finaltotal.item_id, finaltotal.item_desc,finaltotal.qty_in_process, finaltotal.qty_in_transit, finaltotal.order_quantity, finaltotal.total_avail ) as final


group by final.item_id, final.item_desc
order by final.item_id


";

        $this->stmt = $this->dbc->query($sql);

        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);

        $this->perma14usage = round($row['final_calc_usage'],2);
        $this->perma14stock = round($row['total_available'],2);



    }

    public function runHardi12()
    {

        $sql = "Declare @userend2 date
Declare @userstart2 date

Set @userend2 = '2019-02-01'
Set @userstart2 = '2018-02-01'

Declare @userend varchar(30)
Declare @userstart varchar(30)
Declare @supplierID varchar(30)

Set @userend = substring(convert(varchar,@userend2),1,4) + substring(convert(varchar,@userend2),6,2)/*'201712'*/
Set @userstart = substring(convert(varchar,@userstart2),1,4) + substring(convert(varchar,@userstart2),6,2)/*'201706' */

Declare @NumPeriods as int

set @NumPeriods = Iif(CONVERT(INT,(substring(@userstart,1,4))) < CONVERT(INT,(substring(@userend,1,4))),
(13 - CONVERT(INT,(substring(@userstart,5,2)))) + CONVERT(INT,(substring(@userend,5,2))),
CONVERT(INT,(substring(@userend,5,2))) - CONVERT(INT,(substring(@userstart,5,2))) + 1)

/*FINAL TOTALS*****************************************************************************************/
SELECT final.item_id, final.item_desc,(sum(totalCalcUsage)/@NumPeriods) as final_calc_usage, sum(final.total_avail) as total_available

from

/*TOTALS*****************************************************************************************/
(
select finaltotal.item_id, finaltotal.item_desc,sum(finaltotal.usage) as totalCalcUsage, sum(finaltotal.number_of_orders) as total_number_of_orders,
finaltotal.qty_in_process, finaltotal.qty_in_transit, finaltotal.order_quantity, finaltotal.total_avail

from

(
SELECT

aaaraw.item_id, aaaraw.item_desc, aaaraw.location_id, demand_period.computed_year_period, aaaraw.demand_period_uid, sum(aaaraw.inv_period_usage) as usage, sum(aaaraw.number_of_orders) as number_of_orders,
aaaraw.qty_in_process, aaaraw.qty_in_transit, aaaraw.order_quantity, ((aaaraw.qty_on_hand + aaaraw.order_quantity + aaaraw.qty_in_transit) - (aaaraw.qty_allocated + aaaraw.qty_backordered)) as total_avail

FROM

(
SELECT dbo.inv_mast.inv_mast_uid,
dbo.inv_mast.item_id,
dbo.inv_mast.item_desc,
dbo.inv_loc.product_group_id,
dbo.inv_loc.location_id,
dbo.inv_loc.primary_supplier_id,
dbo.inv_loc.inv_min,
dbo.inv_loc.inv_max,
dbo.inv_period_usage.number_of_orders,
dbo.inv_loc.stockable,
IsNull(inv_period_usage,0) AS inv_period_usage,


IsNull(dbo.inv_period_usage.demand_period_uid,


	(case when convert(int,left(@userend,4)) > '2016'
		then @userend - (199999 + 88*(convert(int,left(@userend,4))-2000))
		ELSE
		@userend - (200000 + (88*(convert(int,left(@userend,4))- 2000)))
		end


)) as demand_period_uid,


dbo.inv_loc.qty_on_hand,
dbo.inv_loc.qty_in_process,
dbo.inv_loc.qty_allocated,
dbo.inv_loc.qty_backordered,
dbo.inv_loc.qty_in_transit,
dbo.inv_loc.order_quantity
FROM dbo.inv_mast

	LEFT JOIN dbo.inv_loc ON dbo.inv_mast.inv_mast_uid = dbo.inv_loc.inv_mast_uid
	LEFT JOIN dbo.inv_period_usage ON dbo.inv_mast.inv_mast_uid = dbo.inv_period_usage.inv_mast_uid and dbo.inv_loc.location_id = dbo.inv_period_usage.location_id


WHERE  inv_loc.stockable = 'Y' and inv_loc.delete_flag = 'N' and inv_loc.discontinued = 'N' and dbo.inv_mast.item_id = 'HARDI030512'
	) aaaraw



LEFT JOIN dbo.demand_period ON aaaraw.demand_period_uid = demand_period.demand_period_uid
WHERE (computed_year_period between @userstart and @userend)

group by aaaraw.item_id, aaaraw.item_desc, aaaraw.qty_on_hand, aaaraw.qty_allocated, aaaraw.qty_backordered, aaaraw.qty_in_process, aaaraw.qty_in_transit, aaaraw.order_quantity, demand_period.computed_year_period,
aaaraw.location_id, aaaraw.inv_period_usage, aaaraw.demand_period_uid  ) as finaltotal

group by finaltotal.item_id, finaltotal.item_desc,finaltotal.qty_in_process, finaltotal.qty_in_transit, finaltotal.order_quantity, finaltotal.total_avail ) as final


group by final.item_id, final.item_desc
order by final.item_id


";

        $this->stmt = $this->dbc->query($sql);


        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);

        $this->hardi12usage = round($row['final_calc_usage'],2);
        $this->hardi12stock = round($row['total_available'],2);



    }

    public function runHardi14()
    {

        $sql = "Declare @userend2 date
Declare @userstart2 date

Set @userend2 = '2019-02-01'
Set @userstart2 = '2018-02-01'

Declare @userend varchar(30)
Declare @userstart varchar(30)
Declare @supplierID varchar(30)

Set @userend = substring(convert(varchar,@userend2),1,4) + substring(convert(varchar,@userend2),6,2)/*'201712'*/
Set @userstart = substring(convert(varchar,@userstart2),1,4) + substring(convert(varchar,@userstart2),6,2)/*'201706' */

Declare @NumPeriods as int

set @NumPeriods = Iif(CONVERT(INT,(substring(@userstart,1,4))) < CONVERT(INT,(substring(@userend,1,4))),
(13 - CONVERT(INT,(substring(@userstart,5,2)))) + CONVERT(INT,(substring(@userend,5,2))),
CONVERT(INT,(substring(@userend,5,2))) - CONVERT(INT,(substring(@userstart,5,2))) + 1)

/*FINAL TOTALS*****************************************************************************************/
SELECT final.item_id, final.item_desc,(sum(totalCalcUsage)/@NumPeriods) as final_calc_usage, sum(final.total_avail) as total_available

from

/*TOTALS*****************************************************************************************/
(
select finaltotal.item_id, finaltotal.item_desc,sum(finaltotal.usage) as totalCalcUsage, sum(finaltotal.number_of_orders) as total_number_of_orders,
finaltotal.qty_in_process, finaltotal.qty_in_transit, finaltotal.order_quantity, finaltotal.total_avail

from

(
SELECT

aaaraw.item_id, aaaraw.item_desc, aaaraw.location_id, demand_period.computed_year_period, aaaraw.demand_period_uid, sum(aaaraw.inv_period_usage) as usage, sum(aaaraw.number_of_orders) as number_of_orders,
aaaraw.qty_in_process, aaaraw.qty_in_transit, aaaraw.order_quantity, ((aaaraw.qty_on_hand + aaaraw.order_quantity + aaaraw.qty_in_transit) - (aaaraw.qty_allocated + aaaraw.qty_backordered)) as total_avail

FROM

(
SELECT dbo.inv_mast.inv_mast_uid,
dbo.inv_mast.item_id,
dbo.inv_mast.item_desc,
dbo.inv_loc.product_group_id,
dbo.inv_loc.location_id,
dbo.inv_loc.primary_supplier_id,
dbo.inv_loc.inv_min,
dbo.inv_loc.inv_max,
dbo.inv_period_usage.number_of_orders,
dbo.inv_loc.stockable,
IsNull(inv_period_usage,0) AS inv_period_usage,


IsNull(dbo.inv_period_usage.demand_period_uid,


	(case when convert(int,left(@userend,4)) > '2016'
		then @userend - (199999 + 88*(convert(int,left(@userend,4))-2000))
		ELSE
		@userend - (200000 + (88*(convert(int,left(@userend,4))- 2000)))
		end


)) as demand_period_uid,


dbo.inv_loc.qty_on_hand,
dbo.inv_loc.qty_in_process,
dbo.inv_loc.qty_allocated,
dbo.inv_loc.qty_backordered,
dbo.inv_loc.qty_in_transit,
dbo.inv_loc.order_quantity
FROM dbo.inv_mast

	LEFT JOIN dbo.inv_loc ON dbo.inv_mast.inv_mast_uid = dbo.inv_loc.inv_mast_uid
	LEFT JOIN dbo.inv_period_usage ON dbo.inv_mast.inv_mast_uid = dbo.inv_period_usage.inv_mast_uid and dbo.inv_loc.location_id = dbo.inv_period_usage.location_id


WHERE  inv_loc.stockable = 'Y' and inv_loc.delete_flag = 'N' and inv_loc.discontinued = 'N' and dbo.inv_mast.item_id = 'HARDI030514'
	) aaaraw



LEFT JOIN dbo.demand_period ON aaaraw.demand_period_uid = demand_period.demand_period_uid
WHERE (computed_year_period between @userstart and @userend)

group by aaaraw.item_id, aaaraw.item_desc, aaaraw.qty_on_hand, aaaraw.qty_allocated, aaaraw.qty_backordered, aaaraw.qty_in_process, aaaraw.qty_in_transit, aaaraw.order_quantity, demand_period.computed_year_period,
aaaraw.location_id, aaaraw.inv_period_usage, aaaraw.demand_period_uid  ) as finaltotal

group by finaltotal.item_id, finaltotal.item_desc,finaltotal.qty_in_process, finaltotal.qty_in_transit, finaltotal.order_quantity, finaltotal.total_avail ) as final


group by final.item_id, final.item_desc
order by final.item_id


";

        $this->stmt = $this->dbc->query($sql);

        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);

        $this->hardi14usage = round($row['final_calc_usage'],2);
        $this->hardi14stock = round($row['total_available'],2);



    }


    // returns result
    public function run()
    {

        $sql = "Declare @userend2 date
    Declare @userstart2 date

    Set @userend2 = '2019-02-01'
    Set @userstart2 = '2018-02-01'

    Declare @userend varchar(30)
    Declare @userstart varchar(30)
    Declare @supplierID varchar(30)

    Set @userend = substring(convert(varchar,@userend2),1,4) + substring(convert(varchar,@userend2),6,2)/*'201712'*/
    Set @userstart = substring(convert(varchar,@userstart2),1,4) + substring(convert(varchar,@userstart2),6,2)/*'201706' */

    Declare @NumPeriods as int

    set @NumPeriods = Iif(CONVERT(INT,(substring(@userstart,1,4))) < CONVERT(INT,(substring(@userend,1,4))),
    (13 - CONVERT(INT,(substring(@userstart,5,2)))) + CONVERT(INT,(substring(@userend,5,2))),
    CONVERT(INT,(substring(@userend,5,2))) - CONVERT(INT,(substring(@userstart,5,2))) + 1)

    /*FINAL TOTALS*****************************************************************************************/
    SELECT final.item_id, final.item_desc,(sum(totalCalcUsage)/@NumPeriods) as final_calc_usage, sum(final.total_avail) as total_available

    from

    /*TOTALS*****************************************************************************************/
    (
    select finaltotal.item_id, finaltotal.item_desc,sum(finaltotal.usage) as totalCalcUsage, sum(finaltotal.number_of_orders) as total_number_of_orders,
    finaltotal.qty_in_process, finaltotal.qty_in_transit, finaltotal.order_quantity, finaltotal.total_avail

    from

    (
    SELECT

    aaaraw.item_id, aaaraw.item_desc, aaaraw.location_id, demand_period.computed_year_period, aaaraw.demand_period_uid, sum(aaaraw.inv_period_usage) as usage, sum(aaaraw.number_of_orders) as number_of_orders,
    aaaraw.qty_in_process, aaaraw.qty_in_transit, aaaraw.order_quantity, ((aaaraw.qty_on_hand + aaaraw.order_quantity + aaaraw.qty_in_transit) - (aaaraw.qty_allocated + aaaraw.qty_backordered)) as total_avail

    FROM

    (
    SELECT dbo.inv_mast.inv_mast_uid,
    dbo.inv_mast.item_id,
    dbo.inv_mast.item_desc,
    dbo.inv_loc.product_group_id,
    dbo.inv_loc.location_id,
    dbo.inv_loc.primary_supplier_id,
    dbo.inv_loc.inv_min,
    dbo.inv_loc.inv_max,
    dbo.inv_period_usage.number_of_orders,
    dbo.inv_loc.stockable,
    IsNull(inv_period_usage,0) AS inv_period_usage,


    IsNull(dbo.inv_period_usage.demand_period_uid,


        (case when convert(int,left(@userend,4)) > '2016'
            then @userend - (199999 + 88*(convert(int,left(@userend,4))-2000))
            ELSE
            @userend - (200000 + (88*(convert(int,left(@userend,4))- 2000)))
            end


    )) as demand_period_uid,


    dbo.inv_loc.qty_on_hand,
    dbo.inv_loc.qty_in_process,
    dbo.inv_loc.qty_allocated,
    dbo.inv_loc.qty_backordered,
    dbo.inv_loc.qty_in_transit,
    dbo.inv_loc.order_quantity
    FROM dbo.inv_mast

        LEFT JOIN dbo.inv_loc ON dbo.inv_mast.inv_mast_uid = dbo.inv_loc.inv_mast_uid
        LEFT JOIN dbo.inv_period_usage ON dbo.inv_mast.inv_mast_uid = dbo.inv_period_usage.inv_mast_uid and dbo.inv_loc.location_id = dbo.inv_period_usage.location_id


    WHERE  inv_loc.stockable = 'Y' and inv_loc.delete_flag = 'N' and inv_loc.discontinued = 'N' and dbo.inv_mast.item_id = 'HARDI030514' or dbo.inv_mast.item_id = 'HARDI030512' or dbo.inv_mast.item_id = 'CB2314'  or dbo.inv_mast.item_id = 'CB3612'
        ) aaaraw



    LEFT JOIN dbo.demand_period ON aaaraw.demand_period_uid = demand_period.demand_period_uid
    WHERE (computed_year_period between @userstart and @userend)

    group by aaaraw.item_id, aaaraw.item_desc, aaaraw.qty_on_hand, aaaraw.qty_allocated, aaaraw.qty_backordered, aaaraw.qty_in_process, aaaraw.qty_in_transit, aaaraw.order_quantity, demand_period.computed_year_period,
    aaaraw.location_id, aaaraw.inv_period_usage, aaaraw.demand_period_uid  ) as finaltotal

    group by finaltotal.item_id, finaltotal.item_desc,finaltotal.qty_in_process, finaltotal.qty_in_transit, finaltotal.order_quantity, finaltotal.total_avail ) as final


    group by final.item_id, final.item_desc
    order by final.item_id


    ";
        $this->stmt = $this->dbc->query($sql);

        return $this->stmt;

    }

    /**
     * Get the value of perma12usage
     */
    public function getPerma12usage()
    {
        return $this->perma12usage;
    }

    /**
     * Set the value of perma12usage
     *
     * @return  self
     */
    public function setPerma12usage($perma12usage)
    {
        $this->perma12usage = $perma12usage;

        return $this;
    }

    /**
     * Get the value of perma14usage
     */
    public function getPerma14usage()
    {
        return $this->perma14usage;
    }

    /**
     * Set the value of perma14usage
     *
     * @return  self
     */
    public function setPerma14usage($perma14usage)
    {
        $this->perma14usage = $perma14usage;

        return $this;
    }

    /**
     * Get the value of hardi12usage
     */
    public function getHardi12usage()
    {
        return $this->hardi12usage;
    }

    /**
     * Set the value of hardi12usage
     *
     * @return  self
     */
    public function setHardi12usage($hardi12usage)
    {
        $this->hardi12usage = $hardi12usage;

        return $this;
    }

    /**
     * Get the value of hardi14usage
     */
    public function getHardi14usage()
    {
        return $this->hardi14usage;
    }

    /**
     * Set the value of hardi14usage
     *
     * @return  self
     */
    public function setHardi14usage($hardi14usage)
    {
        $this->hardi14usage = $hardi14usage;

        return $this;
    }

    /**
     * Get the value of perma12stock
     */
    public function getPerma12stock()
    {
        return $this->perma12stock;
    }

    /**
     * Set the value of perma12stock
     *
     * @return  self
     */
    public function setPerma12stock($perma12stock)
    {
        $this->perma12stock = $perma12stock;

        return $this;
    }

    /**
     * Get the value of perma14stock
     */
    public function getPerma14stock()
    {
        return $this->perma14stock;
    }

    /**
     * Set the value of perma14stock
     *
     * @return  self
     */
    public function setPerma14stock($perma14stock)
    {
        $this->perma14stock = $perma14stock;

        return $this;
    }

    /**
     * Get the value of hardi12stock
     */
    public function getHardi12stock()
    {
        return $this->hardi12stock;
    }

    /**
     * Set the value of hardi12stock
     *
     * @return  self
     */
    public function setHardi12stock($hardi12stock)
    {
        $this->hardi12stock = $hardi12stock;

        return $this;
    }

    /**
     * Get the value of hardi14stock
     */
    public function getHardi14stock()
    {
        return $this->hardi14stock;
    }

    /**
     * Set the value of hardi14stock
     *
     * @return  self
     */
    public function setHardi14stock($hardi14stock)
    {
        $this->hardi14stock = $hardi14stock;

        return $this;
    }
}
