<?php
Route::get('/filtro',function(){
    return view('site.filtro');
})->name('filtro');

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

Route::get('/relatorioAnuidade', function(){
    return view('site.relatorioAnuidade');
})->name('rAnuidade');

Route::get('/relatorioMulta', function(){
    return view('site.relatorioMulta');
})->name('rMulta');

Route::get('/edit/{user}', 'DividaAtiva\\dividaController@edit')->name('editRegistro');

Route::put('/editar/{user}', 'DividaAtiva\\dividaController@editar')->name('editarRegistro');

Route::post('/formCadAnuidade','Anuidades\\anuidadeController@store')->name('formCadAnuidade');

Route::post('/formCadMulta','Multas\\multaController@store')->name('formCadMulta');

Route::post('/buscar','DividaAtiva\\dividaController@busca')->name('buscarUsuario');

Route::post('/pdfAnuidadeAno','Anuidades\\anuidadeController@gerarPdfAno' )->name('pdfAnuidadeAno');

Route::post('/pdfAnuidadeMes','Anuidades\\anuidadeController@gerarPdfMes' )->name('pdfAnuidadeMes');

Route::post('/pdfMultaAno','Multas\\multaController@gerarPdfAno' )->name('pdfMultaAno');

Route::post('/pdfMultaMes','Multas\\multaController@gerarPdfMes' )->name('pdfMultaMes');

Route::get('/divida-ativa','DividaAtiva\\dividaController@index')->name('home');




