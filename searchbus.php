<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Contruction Business Directory</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style type="text/css">
    </style>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src='//production-assets.codepen.io/assets/editor/live/console_runner-079c09a0e3b9ff743e39ee2d5637b9216b3545af0de366d4b9aad9dc87e26bfd.js'></script>
    <script src='//production-assets.codepen.io/assets/editor/live/events_runner-73716630c22bbc8cff4bd0f07b135f00a0bdc5d14629260c3ec49e5606f98fdd.js'></script>
    <script src='//production-assets.codepen.io/assets/editor/live/css_live_reload_init-2c0dc5167d60a5af3ee189d570b1835129687ea2a61bee3513dee3a50c115a77.js'></script>
    <link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
    <link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg"
        color="#111" />
    <link rel="canonical" href="https://codepen.io/ericwinton/pen/jqKyyq?depth=everything&order=popularity&page=7&q=product&show_forks=false" />
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU'
        crossorigin='anonymous'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
<style class="cp-pen-styles">
body {
	padding-top: 20px;
}
.product {
	margin-bottom: 20px;
}
.product-inner {
	box-shadow: 0 0 10px rgba(0,0,0,.2);
	padding: 10px;
}
/* .product img {
    margin-bottom: 10px;

} */
img {
    height: 170px;
    width: 200px;
    margin:auto;
    margin-bottom:10px;
    margin-top:10px;
    display:block;

}
span {

    margin-left:10px;
}
</style>
</head>
<body>
<?php
header("content-type:charset=utf-8");
// Initialize variable for database credentials
$dbhost = '127.0.0.1';
$dbuser = 'root';
$dbpass = '';
$dbname = 'oskb';
//Create database connection
$dblink = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
$sql = ("SELECT `AN_Name`,`Entity_Name`,`AN_Address`,`P_Name` FROM `announce` as d1 
INNER JOIN `entity_has_announce` as d2 
ON d1.AN_ID = d2.announce_AN_ID 
INNER JOIN `entity` as d3 
ON d2.entity_ID_Entity = d3.ID_Entity 
INNER JOIN `pictures` as d4");

$x =0;
//Check connection was successful
  if ($dblink->connect_errno) {
     printf("Failed to connect to database");
     exit();
  }
//Fetch 3 rows from actor table
  $dblink->set_charset("utf8");
  $result = $dblink->query($sql);
  
//   foreach($result as $sql2){
//     $make[$x] = $sql2['AN_Name'];
//     $sqll = "SELECT `Entity_Name` FROM `entity` as d1 INNER JOIN `entity_has_announce` as d2 ON d1.`ID_Entity`= d2.entity_ID_Entity WHERE `announce_AN_ID` = ".$sql2['AN_ID'];
//     $result2 = $dblink->query($sqll);
//     $y=0;
//     foreach($result2 as $sq){
//     $model[$x][$y] = $sq['Entity_Name'];
//     $y++;
//     }
//     $type[$x] = $sql2['AN_Address'];
//     $x++;
//     echo json_encode($sql2 + $sq);
// }
//Initialize array variable
  $dbdata = array();
//Fetch into associative array
  while ( $row = $result->fetch_assoc())  {
    $dbdata[]=$row;
    $test = $row;
  }
//   while ( $row = $result2->fetch_assoc()){
//     $dbdataa[] = $row;  
//   }
//   var_dump($test);
  $dataencode = json_encode($dbdata);
//Print array in JSON format
// echo json_encode($dbdata);
?>
    <div class="container">
        <div class="row" id="search">
            <form id="search-form" action="" method="POST" enctype="multipart/form-data">
                <div class="form-group col-xs-9">
                    <input class="form-control text-center" type="text" placeholder="Search" />
                </div>
                <div class="form-group col-xs-3 col-xs-6">
                    <button type="submit" class="btn btn-block btn-success">Search</button>
                </div>
            </form>
        </div>
        <div class="row" id="filter">
            <form>
                <div class="form-group col-sm-3 col-xs-6">
                    <select data-filter="make" class="filter-make filter form-control">
                        <option value="">Select Business</option>
                        <option value="">Show All</option>
                    </select>
                </div>
                <!-- <div class="form-group col-sm-3 col-xs-6">
                    <select data-filter="model" class="filter-model filter form-control">
                        <option value="">Select Sup group</option>
                        <option value="">Show All</option>
                    </select>
                </div> -->
                <div class="form-group col-sm-3 col-xs-6">
                    <select data-filter="type" class="filter-type filter form-control">
                        <option value="">Select Location</option>
                        <option value="">Show All</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="row" id="products">

        </div>
    </div>
    <script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>
    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
    <script>
        let data = <?php echo json_encode($dbdata); ?>;
        data33 ="img/";
                for(i=0;i<data.length;i++){
                    data22 = [data[i].Entity_Name];
                    // data33 = JSON.stringify("img/" + data2[i].P_Name);
                    data33 = data33+data[i].P_Name;
                    data[i].Entity_Name = data22
                    data[i].P_Name = data33;
                }
                console.log(data[0].P_Name);
                console.log(data);
        // data = JSON.parse(data);
        // console.log(typeof(data));
        // console.log(data);
        // data = [
        // 	{
        // 		"make": "PRIME Wellness Group Co., Ltd.",
        // 		"model": ["งานก่อสร้างอาคาร","jtrjtrjrtkrtk"],
        // 		"type": "นราธิวาส",
        // 		"image": "img/fff.png"
        // 	},
        // 	{
        // 		"make": "Mycollection",
        // 		"model": ["(*&^%$#W","85975650o6po87pt"],
        // 		"type": "ปทุมธานี",
        // 		"image": "http://placehold.it/800x600/418cf4/fff"
        // 	},
        // 	{
        // 		"make": "เอชเคเนชั่นแนลโปรดัคทส์จำกัด",
        // 		"model": ["54uj5ekj[e[rkjeork","yweryhsrfjdfj"],
        // 		"type": "นนทบุรี",
        // 		"image": "http://placehold.it/800x600/418cf4/fff"
        // 	},
        // 	{
        // 		"make": "Proffer Complement Co.,Ltd",
        // 		"model": ["hrhwrhsehaehad","qy43wyrewuhystrut"],
        // 		"type": "นครปฐม",
        // 		"image": "http://placehold.it/800x600/418cf4/fff"
        // 	},
        // 	{
        // 		"make": "First Floor Consultants Co.ltd.",
        // 		"model": ["y4wu5ei5irt","Y4A3EURSEDJDFJ"],
        // 		"type": "นครศรีธรรมราช",
        // 		"image": "http://placehold.it/800x600/418cf4/fff"
        // 	},
        // 	{
        // 		"make": "97 Home Builder",
        // 		"model": ["gshshjsjs","jtrdjfgcjnfcvn"],
        // 		"type": "ภูเก็ต",
        // 		"image": "http://placehold.it/800x600/418cf4/fff"
        // 	},
        // 	{
        // 		"make": "Inter management co.ltd.",
        // 		"model": ["เำำไเ้ำไ้ำไ้ไำ้","hershxdfvnxcvn"],
        // 		"type": "พังงา",
        // 		"image": "http://placehold.it/800x600/418cf4/fff"
        //     },
        //     {
        // 		"make": "Admin %$#@@@!",
        // 		"model": ["แอร์","45ktfgkfgmghm","gewgwegewaaa"],
        // 		"type": "กรุงเทพมหานคร",
        // 		"image": "http://placehold.it/800x600/418cf4/fff"
        // 	},
        //     {
        // 		"make": "Admin %$#@@@!",
        // 		"model": ["พัดลม","กาแฟ","โอวัลติน"],
        // 		"type": "กรุงเทพมหานคร",
        // 		"image": "http://placehold.it/800x600/418cf4/fff"
        // 	}
        // ];
        let arr = data.reduce((acc,cur) => {
                      let index = acc.findIndex(el => el.AN_Name === cur.AN_Name);
                      if (index > -1){
                            acc[index].Entity_Name = [...acc[index].Entity_Name, ...cur.Entity_Name]
                            return acc
                      }else{
                            return [...acc, cur]
                      }
                      }, [])
                      data=arr;

        console.log(typeof(data));
        console.log(data);



        var products = "";
        var makes = "";
        var models = "";
        var types = "";
        //consol.log(data);
        // alert(data['make']);
        for (var i = 0; i < data.length; i++) {
            for(var j=0;j<data[i].Entity_Name.length;j++){
            if (window.CP.shouldStopExecution(1)) { break; }
            var make = data[i].AN_Name,
                type = data[i].AN_Adress,
                image = data[i].P_Name;
                model = data[i].Entity_Name;

              
            //create dropdown of makes
            if (makes.indexOf("<option value='" + make + "'>" + make + "</option>") == -1) {
                makes += "<option value='" + make + "'>" + make + "</option>";
            }

            //create dropdown of models

                if (models.indexOf("<option value='" + data[i].model +  "'>" + data[i].model + "</option>") == -1) {
                models += "<option value='" + data[i].model + "'>" + data[i].model + "</option>";
            }
            

            //create dropdown of types
            if (types.indexOf("<option value='" + type + "'>" + type + "</option>") == -1) {
                types += "<option value='" + type + "'>" + type + "</option>";
            }
        }
        //create product cards
        products += "<div class='col-sm-4 product' data-make='" + make + "' data-model='" + model + "' data-type='" + type + "'><div class='product-inner text-left'><img src='" + image + "'><br /><div><span class='fas fa-landmark' style='font-size:24px'></span> : " + make + "</div><br /><div><span class='fas fa-briefcase' style='font-size:24px'></span> : " + data[i].Entity_Name[0]  + "</div><br /><div><span class='fas fas fa-map-marker-alt' style='font-size:24px'></span> : " + type + "</div><br /></div></div>";
        }
        window.CP.exitedLoop(1);


        $("#products").html(products);
        $(".filter-make").append(makes);
        $(".filter-model").append(models);
        $(".filter-type").append(types);

        var filtersObject = {};

        //on filter change
        $(".filter").on("change", function () {
            var filterName = $(this).data("filter"),
                filterVal = $(this).val();

            if (filterVal == "") {
                delete filtersObject[filterName];
            } else {
                filtersObject[filterName] = filterVal;
            }

            var filters = "";

            for (var key in filtersObject) {
                if (window.CP.shouldStopExecution(2)) { break; }
                if (filtersObject.hasOwnProperty(key)) {
                    filters += "[data-" + key + "='" + filtersObject[key] + "']";
                }
            }
            window.CP.exitedLoop(2);


            if (filters == "") {
                $(".product").show();
            } else {
                $(".product").hide();
                $(".product").hide().filter(filters).show();
            }
        });

        //on search form submit
        $("#search-form").submit(function (e) {
            e.preventDefault();
            var query = $("#search-form input").val().toLowerCase();

            $(".product").hide();
            $(".product").each(function () {
                var make = $(this).data("make").toLowerCase(),
                    model = $(this).data("model").toLowerCase(),
                    type = $(this).data("type").toLowerCase();

                if (make.indexOf(query) > -1 || model.indexOf(query) > -1 || type.indexOf(query) > -1) {
                    $(this).show();
                }
            });
        });
//# sourceURL=pen.js
    </script>
</body>

</html>