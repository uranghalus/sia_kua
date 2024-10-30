<?php
function tanggal_indo($tanggal)
{
	$bulan = array(
		1 => 'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);

	$split = explode('-', $tanggal);
	$tanggal_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
	return $tanggal_indo;
}
function romawi($tanggal)
{
	$bulan = array(
		1 => 'I',
		'II',
		'III',
		'IV',
		'V',
		'VI',
		'VII',
		'VIII',
		'IX',
		'X',
		'XI',
		'XII'
	);

	$split = explode('-', $tanggal);
	$romawi = $bulan[(int)$split[1]];
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
	return $romawi;
}
?>