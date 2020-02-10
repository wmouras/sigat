<?php

Route::get('/divida-ativa','DividaAtiva\\dividaController@index')->name('home');

Route::get('/cadAnuidadeAtivo', function(){
    return view('site.cadastrarAnuidadeAtivo');
}   )->name('anuidadeAtivo');

Route::get('/cadAnuidadeExtinto', function(){
    return view('site.cadastrarAnuidadeExtinto');
})->name('anuidadeExtinto');


Route::get('/cadMultaAtivo', function(){
    return view('site.cadastrarMultaAtivo');
}   )->name('multaAtivo');

Route::get('/cadMultaExtinto', function(){
    return view('site.cadastrarMultaExtinto');
}   )->name('multaExtinto');

Route::post('/pdfAnuidadeAno','Anuidades\\anuidadeController@gerarPdfAno' )->name('pdfAnuidadeAno');

Route::post('/pdfAnuidadeMes','Anuidades\\anuidadeController@gerarPdfMes' )->name('pdfAnuidadeMes');

Route::get('/relatorioAnuidade', function(){
    return view('site.relatorioAnuidade');
})->name('rAnuidade');

Route::get('/relatorioMulta', function(){
    return view('site.relatorioMulta');
})->name('rMulta');

Route::get('/editar', function(){
    return view('site.editarRegistro');
})->name('editarRegistro');


Route::post('/formCadAnuidade','Anuidades\\anuidadeController@store')->name('formCadAnuidade');

Route::post('/formCadMulta','Multas\\multaController@store')->name('formCadMulta');

Route::post('/buscar','DividaAtiva\\dividaController@busca')->name('buscarUsuario');


