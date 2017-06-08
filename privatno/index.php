<?php
include_once '../konfiguracija.php';
if(!isset($_SESSION[$sid . "autoriziran"])){
	header("location: ../odjava.php");
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once '../predlozak/head.php';
		?>
	</head>
	<body>
		<?php
		include_once '../predlozak/izbornik.php';
		?>
		
				<div id="container" style="min-width: 100%; height:100%; margin: 0 auto"></div>

		
		<?php
	include_once "../predlozak/skripta.php";
		?>
		<script src="<?php echo $putanjaAPP ?>js/highcharts.js"></script>
		<script src="<?php echo $putanjaAPP ?>js/exporting.js"></script>
		<script>
			$(function () {

    $(document).ready(function () {

        // Build the chart
        Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: '10 Vlasnika sa najviše zgrada izraženih u postotcima'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Zgrade',
                colorByPoint: true,
                data: [
                
                <?php
                $izraz=$veza->prepare("select vlasnik.sifra, vlasnik.ime, count(zgrada.vlasnik) as ukupno
										from vlasnik inner join zgrada on vlasnik.sifra=zgrada.vlasnik
										group by vlasnik.sifra, vlasnik.ime order by 3 desc limit 10");
                $izraz->execute();
				$niz=$izraz->fetchALL(PDO::FETCH_OBJ);
				foreach ($niz as $red) {
					echo "{name: '" . $red->ime . "',y: " . $red->ukupno . "}, ";
				}
				
				 ?>
                
               
                ]
            }]
        });
    });
});
		</script>
	</body>
</html>
