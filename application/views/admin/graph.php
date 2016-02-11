<?php 
$dates=array();
foreach ($this->data['dates'] as $key => $value) {
    $dates[$key]="'".$value."'";
}
$dates=implode(',',$dates);

$total=array_keys($this->data['payments']);
$date=array_values($this->data['payments']);

$total=implode(',',$total);

// print_r($date);

?>

<script>
$(document).ready(function(){

    $('#container').highcharts({
            chart: {
                type: 'column',
                margin: [ 50, 50, 100, 80]
            },
            title: {
                text: 'Weekly Payment'
            },
            xAxis: {
                categories: [
                    //Dates
                    <?php echo $dates;?>
                ],
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Payment ($)'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'Total Payment in : <b>{point.y:.1f} $</b>',
            },
            series: [{
                name: 'Payment',
                data: [<?php echo $total;?>],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    x: 4,
                    y: 10,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif',
                        textShadow: '0 0 3px black'
                    }
                }
            }]
        });
    });
    

</script>
<div id="container"></div>