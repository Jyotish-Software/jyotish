<?php
require './vendor/autoload.php';
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
use Jyotish\Base\Data;
use Jyotish\Base\Locality;
use Jyotish\Base\Analysis;
use Jyotish\Ganita\Method\Swetest;
use Jyotish\Dasha\Dasha;
$Locality = new Locality([
            'longitude' => "77.80",
            'latitude' => "11.56",
            'altitude' => 0,
            ]);
$DateTime = new DateTime();
$DateTime->setTimezone(new DateTimeZone('Asia/Kolkata'));
$DateTime->setDate(2000, 8, 27);
$DateTime->setTime(15,28);
// $Ganita = new Swetest(["swetest" => ""]);
// // for linux
// // run sudo apt install libswe-dev
// // after that use 
$Ganita = new Swetest(["swetest" => "./vendor/kunjara/swetest/win/"]);
// $Ganita = new Swetest(["swetest" => "/usr/bin/"]);
$data = new Data($DateTime, $Locality, $Ganita);
// To Calculate Panchangam
$data->calcParams();
$data->calcRising();
$data->calcPanchanga();
// To calculate Upagraha
$data->calcUpagraha();

$data->calcDasha("vimshottari", null);
		// $data->calcYoga(['mahapurusha','Dhana','RAJA']);
		// $data->calcHora();
	$data->calcExtraLagna();
	// $data->calcBhavaArudha();
	$Analysis = new Analysis($data);
		$new = [
			"data" => $data,
			"Analysis" => $Analysis,
		];


$dasha = $data->getData()['dasha']['vimshottari']['periods'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h3>Panchanga</h3>
				<ul>
					<li>Thiti: <?php echo $data->getData()['panchanga']['tithi']['paksha'] . ' ' .$data->getData()['panchanga']['tithi']['name'] . ' ' .round($data->getData()['panchanga']['tithi']['left'], 2) . ' % left'; ?></li>
					<li>Nakshatra: <?php echo $data->getData()['panchanga']['nakshatra']['name']; ?></li>
					<li>Yoga: <?php echo $data->getData()['panchanga']['yoga']['name']; ?></li>
					<li>Vara: <?php echo $data->getData()['panchanga']['vara']['name']; ?> Lord: <?php echo $data->getData()['panchanga']['vara']['key']; ?></li>
					<li>Karana: <?php echo $data->getData()['panchanga']['karana']['name']; ?></li>
				</ul>
			</div>

			<div class="col-md-4">
				<h5>D1 Details</h5>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Degree</th>
							<th>Sign</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data->getData()['lagna'] as $key => $lagna): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $lagna['longitude']; ?></td>
							<td><?php echo $lagna['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
						<?php foreach ($data->getData()['graha'] as $key => $graha): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $graha['longitude']; ?></td>
							<td><?php echo $graha['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<h5>D2 Details</h5>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Degree</th>
							<th>Sign</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($Analysis->getVargaData("D2")['lagna'] as $key => $lagna): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $lagna['longitude']; ?></td>
							<td><?php echo $lagna['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
						<?php foreach ($Analysis->getVargaData("D2")['graha'] as $key => $graha): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $graha['longitude']; ?></td>
							<td><?php echo $graha['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<h5>D3 Details</h5>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Degree</th>
							<th>Sign</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($Analysis->getVargaData("D3")['lagna'] as $key => $lagna): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $lagna['longitude']; ?></td>
							<td><?php echo $lagna['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
						<?php foreach ($Analysis->getVargaData("D3")['graha'] as $key => $graha): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $graha['longitude']; ?></td>
							<td><?php echo $graha['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<h5>D4 Details</h5>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Degree</th>
							<th>Sign</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($Analysis->getVargaData("D4")['lagna'] as $key => $lagna): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $lagna['longitude']; ?></td>
							<td><?php echo $lagna['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
						<?php foreach ($Analysis->getVargaData("D4")['graha'] as $key => $graha): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $graha['longitude']; ?></td>
							<td><?php echo $graha['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<h5>D7 Details</h5>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Degree</th>
							<th>Sign</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($Analysis->getVargaData("D7")['lagna'] as $key => $lagna): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $lagna['longitude']; ?></td>
							<td><?php echo $lagna['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
						<?php foreach ($Analysis->getVargaData("D7")['graha'] as $key => $graha): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $graha['longitude']; ?></td>
							<td><?php echo $graha['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<h5>D9 Details</h5>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Degree</th>
							<th>Sign</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($Analysis->getVargaData("D9")['lagna'] as $key => $lagna): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $lagna['longitude']; ?></td>
							<td><?php echo $lagna['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
						<?php foreach ($Analysis->getVargaData("D9")['graha'] as $key => $graha): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $graha['longitude']; ?></td>
							<td><?php echo $graha['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<h5>D10 Details</h5>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Degree</th>
							<th>Sign</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($Analysis->getVargaData("D10")['lagna'] as $key => $lagna): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $lagna['longitude']; ?></td>
							<td><?php echo $lagna['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
						<?php foreach ($Analysis->getVargaData("D10")['graha'] as $key => $graha): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $graha['longitude']; ?></td>
							<td><?php echo $graha['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<h5>D12 Details</h5>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Degree</th>
							<th>Sign</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($Analysis->getVargaData("D12")['lagna'] as $key => $lagna): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $lagna['longitude']; ?></td>
							<td><?php echo $lagna['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
						<?php foreach ($Analysis->getVargaData("D12")['graha'] as $key => $graha): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $graha['longitude']; ?></td>
							<td><?php echo $graha['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<h5>D16 Details</h5>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Degree</th>
							<th>Sign</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($Analysis->getVargaData("D16")['lagna'] as $key => $lagna): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $lagna['longitude']; ?></td>
							<td><?php echo $lagna['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
						<?php foreach ($Analysis->getVargaData("D16")['graha'] as $key => $graha): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $graha['longitude']; ?></td>
							<td><?php echo $graha['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<h5>D20 Details</h5>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Degree</th>
							<th>Sign</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($Analysis->getVargaData("D20")['lagna'] as $key => $lagna): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $lagna['longitude']; ?></td>
							<td><?php echo $lagna['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
						<?php foreach ($Analysis->getVargaData("D20")['graha'] as $key => $graha): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $graha['longitude']; ?></td>
							<td><?php echo $graha['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<h5>D24 Details</h5>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Degree</th>
							<th>Sign</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($Analysis->getVargaData("D24")['lagna'] as $key => $lagna): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $lagna['longitude']; ?></td>
							<td><?php echo $lagna['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
						<?php foreach ($Analysis->getVargaData("D24")['graha'] as $key => $graha): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $graha['longitude']; ?></td>
							<td><?php echo $graha['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<h5>D27 Details</h5>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Degree</th>
							<th>Sign</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($Analysis->getVargaData("D27")['lagna'] as $key => $lagna): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $lagna['longitude']; ?></td>
							<td><?php echo $lagna['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
						<?php foreach ($Analysis->getVargaData("D27")['graha'] as $key => $graha): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $graha['longitude']; ?></td>
							<td><?php echo $graha['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<h5>D30 Details</h5>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Degree</th>
							<th>Sign</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($Analysis->getVargaData("D30")['lagna'] as $key => $lagna): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $lagna['longitude']; ?></td>
							<td><?php echo $lagna['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
						<?php foreach ($Analysis->getVargaData("D30")['graha'] as $key => $graha): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $graha['longitude']; ?></td>
							<td><?php echo $graha['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<h5>D40 Details</h5>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Degree</th>
							<th>Sign</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($Analysis->getVargaData("D40")['lagna'] as $key => $lagna): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $lagna['longitude']; ?></td>
							<td><?php echo $lagna['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
						<?php foreach ($Analysis->getVargaData("D40")['graha'] as $key => $graha): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $graha['longitude']; ?></td>
							<td><?php echo $graha['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<h5>D45 Details</h5>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Degree</th>
							<th>Sign</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($Analysis->getVargaData("D45")['lagna'] as $key => $lagna): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $lagna['longitude']; ?></td>
							<td><?php echo $lagna['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
						<?php foreach ($Analysis->getVargaData("D45")['graha'] as $key => $graha): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $graha['longitude']; ?></td>
							<td><?php echo $graha['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<h5>D60 Details</h5>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Degree</th>
							<th>Sign</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($Analysis->getVargaData("D60")['lagna'] as $key => $lagna): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $lagna['longitude']; ?></td>
							<td><?php echo $lagna['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
						<?php foreach ($Analysis->getVargaData("D60")['graha'] as $key => $graha): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo $graha['longitude']; ?></td>
							<td><?php echo $graha['rashi']; ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<h2 class="sub-heading-dasha">Vimshotri Maha Dasha</h2>
      <ul>
      	<?php foreach ($dasha as $key => $single): ?>
        <li  class="dasha"><?php echo $key ?> - <?php echo $single['start'] ?> - <?php echo $single['end'] ?>

            <ul class="antradasha">
                <?php foreach ($single['periods'] as $key => $one): ?>
                <h2 class="sub-heading-dasha">Antardasha</h2>
                <li><?php echo $key ?> - <?php echo $one['start'] ?> - <?php echo $one['end'] ?>

                    <ul>
                        <h2 class="sub-heading-dasha">Pratyantardasha</h2>

                	<?php foreach ($one['periods'] as $key => $one): ?>
                        <li><?php echo $key ?> - <?php echo $one['start'] ?> - <?php echo $one['end'] ?></li>
      	<?php endforeach ?>
                    </ul> 
                </li>

      	<?php endforeach ?>
            </ul> 
        </li>   
      	<?php endforeach ?>
    </ul>
			</div>
		</div>
	</div>
</body>
</html>