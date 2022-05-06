<?php require APPROOT . '/views/inc/header.php'; ?>
<?php include_once APPROOT . '/models/Collection.php'; ?>
  <?php flash('post_message'); ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Collections</h1>
    </div>
    <div class="col-md-6">
      <a href="<?php echo URLROOT; ?>/collections/add" class="btn btn-primary pull-right">
        <i class="fa fa-pencil"></i> Add Collection
      </a>
    </div>
  </div>
  <div class="container">
    <canvas id="myChart"></canvas>
  </div>
  <script>
    let myChart = document.getElementById('myChart').getContext('2d');

    // Global Options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    Chart.defaults.global.defaultFontSize = 18;
    Chart.defaults.global.defaultFontColor = '#777';

    let massPopChart = new Chart(myChart, {
      type:'doughnut', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data:{
        labels:['Consumables','WASTE','HAULAGE','Transport', 'TWM FEE' , 'PROJECT' , 'Manpower' , 'Haz' , 'other' ],
        datasets:[{
          label:'Amounts',
          data:[
            <?php 
            $Consumables = 0;
            $WASTE = 0;
            $HAULAGE = 0;
            $Transport = 0;
            $TWMFEE = 0;
            $PROJECT = 0;
            $Manpower = 0;
            $Haz = 0;
            $other = 0;

            foreach($data['collections'] as $collection) {
              if($collection->Transaction_Type == "Consumables"){
                $Consumables = $Consumables + 1;
              }
              elseif($collection->Transaction_Type == "WASTE") {
                $WASTE = $WASTE + 1;
              }
              elseif ($collection->Transaction_Type == "HAULAGE") {
                $HAULAGE = $HAULAGE + 1;
              }
              elseif ($collection->Transaction_Type == "Transport") {
                $Transport = $Transport + 1;
              }
              elseif ($collection->Transaction_Type == "TWM FEE") {
                $TWMFEE = $TWMFEE + 1;
              }
              elseif ($collection->Transaction_Type == "PROJECT") {
                $PROJECT = $PROJECT + 1;
              }
              elseif ($collection->Transaction_Type == "Manpower") {
                $Manpower = $Manpower + 1;
              }
              elseif ($collection->Transaction_Type == "Haz") {
                $Haz = $Haz + 1;
              }
              else {
                $other = $other + 1;
              }
            }

            echo $Consumables . ",";
            echo $WASTE . "," ;
            echo $HAULAGE . "," ;
            echo $Transport . "," ;
            echo $TWMFEE . "," ;
            echo $PROJECT . "," ;
            echo $Manpower . "," ;
            echo $Haz . "," ;
            echo $other;?>
             
          ],
          
          //backgroundColor:'green',
          backgroundColor:[
            'rgba(255, 99, 132, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)',
            'rgba(255, 23, 200, 0.6)',
            'rgba(50, 133, 200, 0.6)',
            'rgba(123, 166, 200, 0.6)'
          ],
          borderWidth:1,
          borderColor:'#777',
          hoverBorderWidth:3,
          hoverBorderColor:'#000'
        }]
      },
      options:{
        title:{
          display:true,
          text:'Totals based off Transaction Type',
          fontSize:25
        },
        legend:{
          display:true,
          position:'right',
          labels:{
            fontColor:'#000'
          }
        },
        layout:{
          padding:{
            left:50,
            right:0,
            bottom:0,
            top:0
          }
        },
        tooltips:{
          enabled:true
        }
      }
    });
  </script>

    
  
<?php require APPROOT . '/views/inc/footer.php'; ?>