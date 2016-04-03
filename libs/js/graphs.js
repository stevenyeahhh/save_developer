google.load("visualization", "1", {packages: ["corechart"]});

//function cargarChart(json, nombre) {
//
////   console.log(google)
//    arr = [];
//    for (el in json[0]) {
////        ele=
//        arr.push([el, (json[0][el]) / 1]);
//    }
//    //////////////
//    var data = new google.visualization.DataTable();
//    data.addColumn('string', 'Topping');
//    data.addColumn('number', 'Slices');
//    data.addRows(arr);
//
//    // Set chart options
//    var options = {'title': nombre
//    };
//    console.log(options);
//    // Instantiate and draw our chart, passing in some options.
////        alert("-.-.-");
//    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
//    chart.draw(data, options);
//} 
function cargarChart2(json, nombre, element) {
    if ($(".report").length == 0) {
        $("<a class='report' href='" + window.location.href + "/1'><img style='width:40px;height:40px' src='" + BASE + "/img/excel.png' ></a>").insertAfter("h1");
    }
    js = json;
    console.log(json)
    arr = [];
    for (el in json) {
        arr.push([json[el]["descripcion"], (json[el]["CNT"]) / 1]);
    }
    //////////////
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Topping');
    data.addColumn('number', 'Conteo');
    data.addRows(arr);

    // Set chart options
//    var options = {'title': nombre, explorer: {
//        maxZoomOut:2,
//        keepInBounds: true
//    }}
//     options = {'title': nombre, explorer: {
//        maxZoomOut:2,
//        keepInBounds: true
//    }
    if(typeof options=="undefined"){
        var options={}
    }
    options.title = "nombre";
    options.explorer = {
        maxZoomOut: 2,
        keepInBounds: true}
//    for (var i = 0; i < MAX; ++i) {
//      data.addRow([i.toString(), Math.floor(Math.random() * 100)]);
//    }
//
//
//    }
//    ;
    console.log(options);
// Instantiate and draw our chart, passing in some options.
//        alert("-.-.-");
//    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
//    var chart = new google.visualization.PieChart(document.getElementById(element));
    var chart = new google.visualization.ColumnChart(document.getElementById(element));
    chart.draw(data, options);
}


function drawChart(array, nombre) {
    var data = google.visualization.arrayToDataTable(array);

    var options = {
        title: nombre
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
}
