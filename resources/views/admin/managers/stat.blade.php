<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Statistics</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <div id="piechart" style="width: 900px; height: 500px;"></div>
      <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
      <div id="piechartOfContries" style="width: 900px; height: 300px;"></div>
      <div id="piechartOfTopten" style="width: 900px; height: 300px;"></div>

    
    
    
    <script>
    ///Pie Chart Start
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawPieChartOfGenders);
    google.charts.setOnLoadCallback(drawColChartOfYears);
    google.charts.setOnLoadCallback(drawPieChartOfTopten);
    google.charts.setOnLoadCallback(drawPieChartOfReservs);

    function drawPieChartOfGenders() {
      var statGenderObj=getStatGenderObj()

      var tableData=[
          ['Gender', 'Numbers'],
          ['Male',     statGenderObj.malesNo],
          ['Female',      statGenderObj.femalesNo],
        ]
      var data = google.visualization.arrayToDataTable(tableData);

      var options = {
        title: 'Gender Statistics'
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
    }

    function getStatGenderObj()
    {
      ///make ajax request here

      return {
        malesNo:8,
        femalesNo:11
      }
    }
      ///Pie Chart End



    // Columns Chart Start

    function drawColChartOfYears() {
      var incomeInyearArr=getIncomeInYear();
      var incomeYear=[
          ["Element", "Income", { role: "style" } ],
          ["January", incomeInyearArr[0], "#b87333"],
          ["February", incomeInyearArr[1], "silver"],
          ["March", incomeInyearArr[2], "gold"],
          ["April", incomeInyearArr[3], "color: #e5e4e2"],
          ["May", incomeInyearArr[4], "#b87333"],
          ["June", incomeInyearArr[5], "silver"],
          ["July", incomeInyearArr[6], "gold"],
          ["August", incomeInyearArr[7], "color: #e5e4e2"],
          ["September", incomeInyearArr[8], "#b87333"],
          ["October", incomeInyearArr[9], "silver"],
          ["November", incomeInyearArr[10], "gold"],
          ["December", incomeInyearArr[11], "color: #e5e4e2"]
        ];
      var data = google.visualization.arrayToDataTable(incomeYear);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Income Of The Last 12 Months",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }

  function getIncomeInYear()
  {
    // make ajax here
    return [11,15,20,9,11,15,20,9,11,15,20,9,11,15,20,9]
  }
  // End Column Chart


  // Start Reservations Pie Chart
      function drawPieChartOfReservs() {
      var statReservsObj=getStatReservsObj();
      var tableData=[
          ['National', 'Numbers'],
          ['Egypt',     statReservsObj.egypt],
          ['NonEgypt',      statReservsObj.nonEgypt],
        ];
      var data = google.visualization.arrayToDataTable(tableData);

      var options = {
        title: 'Gender Statistics'
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechartOfContries'));

      chart.draw(data, options);
    }

    function getStatReservsObj()
    {
      ///make ajax request here

      return {
        egypt:8,
        nonEgypt:20
      }
    }
  // End Reservations Pie Chart


  // Start Top Clients Pie Chart
      function drawPieChartOfTopten() {
      var Topten=getStatToptenObj();

      var tableData=[
          ['Name', 'Numbers'],
          [Topten[0].clientName,     Topten[0].reservNo],
          [Topten[1].clientName,     Topten[1].reservNo],
          [Topten[2].clientName,     Topten[2].reservNo],
          [Topten[3].clientName,     Topten[3].reservNo],
          [Topten[4].clientName,     Topten[4].reservNo],
          [Topten[5].clientName,     Topten[5].reservNo],
          [Topten[6].clientName,     Topten[6].reservNo],
          [Topten[7].clientName,     Topten[7].reservNo],
          [Topten[8].clientName,     Topten[8].reservNo],
          [Topten[9].clientName,     Topten[9].reservNo],
        ]
      var data = google.visualization.arrayToDataTable(tableData);

      var options = {
        title: 'Top Ten Statistics'
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechartOfTopten'));

      chart.draw(data, options);
    }

    function getStatToptenObj()
    {
      ///make ajax request here

      return [
        {clientName:'mohamed',reservNo:2},
        {clientName:'sdsd',reservNo:2},
        {clientName:'mosmed',reservNo:2},
        {clientName:'dfsdf',reservNo:2},
        {clientName:'mohamed',reservNo:2},
        {clientName:'mohamed',reservNo:9},
        {clientName:'mohamed',reservNo:2},
        {clientName:'mohamed',reservNo:2},
        {clientName:'mohamed',reservNo:2},
        {clientName:'mohamed',reservNo:2},
      ]
    }

  // End Top Clients Pie Chart
  </script>
</body>
</html>