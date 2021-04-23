<?php

namespace App\Admin\Controllers;

use App\Produk;
use App\Kategori_produk;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProdukController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Produk';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Produk());

        $grid->column('id', __('Id'));
        $grid->column('kategori_produk.nama_kategori', __('Kategori produk'));
        $grid->column('nama', __('Nama'));
        $grid->column('deskripsi_produk', __('Deskripsi produk'));
        $grid->column('gambar', __('Gambar'));
        $grid->column('stok', __('Stok'));
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Produk::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('kategori_produk.nama_kategori');
        $show->field('nama', __('Nama'));
        $show->field('deskripsi_produk', __('Deskripsi produk'));
        $show->field('gambar', __('Gambar'));
        $show->field('stok', __('Stok'));
        // $show->date('created_at', __('Created at'));
        // $show->date('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Produk());

        $form->number('kategori_produk', __('Kategori produk'));
        $form->text('nama', __('Nama'))->rules('required');
        $form->text('deskripsi_produk', __('Deskripsi produk'));
        // $form->text('gambar', __('Gambar'));
        $form->image('gambar')->uniqueName();
        $form->number('stok', __('Stok'))->rules('required');

        return $form;
    }
}
