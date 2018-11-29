
        data33 = "img/";
        for (i = 0; i < data.length; i++) {
            data22 = [data[i].Entity_Name];
            // data33 = JSON.stringify("img/" + data2[i].P_Name);
            data33 = data33 + data[i].P_Name;
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
        let arr = data.reduce((acc, cur) => {
            let index = acc.findIndex(el => el.AN_Name === cur.AN_Name);
            if (index > -1) {
                acc[index].Entity_Name = [...acc[index].Entity_Name, ...cur.Entity_Name]
                return acc
            } else {
                return [...acc, cur]
            }
        }, [])
        data = arr;

        console.log(typeof (data));
        console.log(data);



        var products = "";
        var makes = "";
        var models = "";
        var types = "";
        //consol.log(data);
        // alert(data['make']);
        for (var i = 0; i < data.length; i++) {
            for (var j = 0; j < data[i].Entity_Name.length; j++) {
                if (window.CP.shouldStopExecution(1)) { break; }
                data[i].P_Name = "img/fff.png"
                var make = data[i].AN_Name,
                    type = data[i].AN_Adress,
                    image = data[i].P_Name;
                model = data[i].Entity_Name;


                //create dropdown of makes
                if (makes.indexOf("<option value='" + make + "'>" + make + "</option>") == -1) {
                    makes += "<option value='" + make + "'>" + make + "</option>";
                }

                //create dropdown of models

                if (models.indexOf("<option value='" + data[i].model + "'>" + data[i].model + "</option>") == -1) {
                    models += "<option value='" + data[i].model + "'>" + data[i].model + "</option>";
                }


                //create dropdown of types
                if (types.indexOf("<option value='" + type + "'>" + type + "</option>") == -1) {
                    types += "<option value='" + type + "'>" + type + "</option>";
                }
            }
            //create product cards
            products += "<div class='col-sm-4 product' data-make='" + make + "' data-model='" + model + "' data-type='" + type + "'><div class='product-inner text-left'><img src='" + image + "'><br /><div><span class='fas fa-landmark' style='font-size:24px'></span> : " + make + "</div><br /><div><span class='fas fa-briefcase' style='font-size:24px'></span> : " + data[i].Entity_Name[0] + "</div><br /><div><span class='fas fas fa-map-marker-alt' style='font-size:24px'></span> : " + type + "</div><br /></div></div>";
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