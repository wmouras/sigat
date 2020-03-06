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

Route::post('/edit/{user}', 'DividaAtiva\\dividaController@edit')->name('editRegistro');

Route::put('/editar/{user}', 'DividaAtiva\\dividaController@editar')->name('editarRegistro');

Route::post('/formCadAnuidade','Anuidades\\anuidadeController@store')->name('formCadAnuidade');

Route::post('/formCadMulta','Multas\\multaController@store')->name('formCadMulta');

Route::post('/buscar','DividaAtiva\\dividaController@busca')->name('buscarUsuario');

Route::post('/pdfAno','DividaAtiva\\dividaController@gerarPdfAno' )->name('pdfAno');

Route::post('/pdfMes','DividaAtiva\\dividaController@gerarPdfMes' )->name('pdfMes');

Route::post('/pdfTodos','DividaAtiva\\dividaController@gerarPdfTodos' )->name('pdfTodos');

Route::get('/divida-ativa','DividaAtiva\\dividaController@index')->name('home');




