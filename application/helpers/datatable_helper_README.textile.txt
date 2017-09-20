h1. DataTable Codeigniter Helper

Server Side Datatable for Codeigniter/ pure PHP Helper 

Datatable soure : http://datatables.net/
Datatable Server Side Source : http://datatables.net/release-datatables/examples/data_sources/server_side.html

Get More info Like this page :
https://www.facebook.com/omapslab

Follow Twitter
@omapslab 


h1. Using

h3. $aCol

Describe column table with Assosiative Array

<b>Array Key</b> is column of Table in use 
<b>Array Values</b> is the 'AS Query' 

Special Elimination when WHERE clause used
<b>Use "@"</b>

example :
<pre>
$aCol = array('id_product' => 'id_product',
              'category' => 'category',
              'name' => 'name',
              'code' => 'code',
              'posting_share' => 'posting_share');
              
</pre>

example with elimination :
<pre>
$aCol = array('id_product' => 'id_product',
              'category' => 'category',
              '@name' => 'name', /* Elimitane nama cols in WHERE*/
              'code' => 'code',
              'posting_share' => 'posting_share');
              
</pre>


h3. $sTable

Describe table name query
example :
<pre>
$sTable = "c_product";

</pre>
 

h3. $sGroupBy

Describe Group By query

example : 
<pre>
$sGroupBy = "id_product";

</pre>

h3. $sIndexTable

Describe index of table in HTML (index = 0)
example :
<pre>
$sIndexTable = 0;

</pre>

h3. $anyWhere

Describe Any condition in WHERE query
example:
<pre>
$anyWhere = "id_product = '$id'"

</pre>

h3. Datatable execute

Execute datatable server side with :  
@datatable_execute($aCol, $sTable, $sGroupBy, $anyWhere);@

<pre>
datatable_excute($aCol, $sTable, $sGroupBy, $sIndexTable, $anyWhere));

</pre>


h1. Full Example Implementation

h3. Simpe

<pre>
$aCol = array('id_product' => 'id_product',
			  'category' => 'category',
			  'name' => 'name',
			  'code' => 'code',
			  'posting_share' => 'posting_share');
$sTable = "c_product";
$sGroupBy = "id_product";
$sIndexTable = 0;
$anyWhere = "id_product = '$id'";
header('Content-Type: application/json');
exit(datatable_excute($aCol, $sTable, $sGroupBy, $sIndexTable, $anyWhere)));
			  
</pre> 

h3. With Join More Table

<pre>
$aCol = array('cp.id_product' => 'id_product',
			  'cc.category' => 'category',
			  'cp.name' => 'name',
			  'cp.code' => 'code',
			  'cp.publish' => 'publish',
			  'CASE WHEN cp.product_resdrop = "yes" THEN "yes" ELSE "no" END' => 'product_resdrop',
			  'CASE WHEN (SELECT id_product_po FROM c_product_po cpo WHERE cpo.id_product = cp.id_product) IS NULL THEN "no" ELSE "yes" END' => 'po',
			  'CASE WHEN (SELECT SUM(stock) as stock_all FROM c_product_varian WHERE id_product = cp.id_product GROUP BY id_product) IS NULL THEN cps.qty ELSE (SELECT SUM(stock) as stock_all FROM c_product_varian WHERE id_product = cp.id_product GROUP BY id_product) END' => 'qty',
			  'cp.posting_share' => 'posting_share',);
$sTable = "c_product cp
		   LEFT JOIN c_product_images cpi ON cp.id_product = cpi.id_product
		   LEFT JOIN c_product_stock cps ON cps.id_product=cp.id_product
		   LEFT JOIN c_product_category cpc ON cpc.id_product = cp.id_product
		   LEFT JOIN c_category cc ON cc.id_category = cpc.id_category";
$sGroupBy = "cp.id_product";
$sIndexTable = 0;
$anyWhere = "cp.publish = 'YES'"

header('Content-Type: application/json');
exit(datatable_excute($aCol, $sTable, $sGroupBy, $indexTable, $anyWhere));
			  
</pre>

h1. Return Data

All will be return json data
Example :
<pre>
{
	"sEcho": 0,
	"iTotalRecords": "261",
	"iTotalDisplayRecords": "261",
	"aaData": [
	
	    {
	        "no": 1,
	        "id_product": "169",
	        "category": "T-Shirt",
	        "name": "T-shirt SS5 Biru Donker",
	        "code": "0010513002",
	        "publish": "yes",
	        "product_resdrop": "no",
	        "po": "no",
	        "qty": "1",
	        "posting_share": "2"
	    },
	    {
	        "no": 2,
	        "id_product": "170",
	        "category": "T-Shirt",
	        "name": "T-shirt SS5 Biru",
	        "code": "0010513003",
	        "publish": "yes",
	        "product_resdrop": "no",
	        "po": "no",
	        "qty": "0",
	        "posting_share": "5"
	    },
	    {
	        "no": 3,
	        "id_product": "171",
	        "category": "Jaket",
	        "name": "Jaket SS5 Staff",
	        "code": "0020513001",
	        "publish": "yes",
	        "product_resdrop": "no",
	        "po": "no",
	        "qty": "0",
	        "posting_share": "0"
	    },
	    {
	        "no": 4,
	        "id_product": "172",
	        "category": "Jaket",
	        "name": "Jaket SS5 Hangul Suju",
	        "code": "0020513002",
	        "publish": "yes",
	        "product_resdrop": "no",
	        "po": "no",
	        "qty": "0",
	        "posting_share": "0"
	    }
	]
}

</pre>



---------
OMAPSLAB


 
 
