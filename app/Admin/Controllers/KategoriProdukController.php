<?php

namespace App\Admin\Controllers;

use App\Kategori_produk;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class KategoriProdukController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Kategori_produk';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Kategori_produk());

        $grid->column('id', __('Id'));
        $grid->column('nama_kategori', __('Nama kategori'));
        $grid->column('deskripsi', __('Deskripsi'));
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
        $show = new Show(Kategori_produk::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nama_kategori', __('Nama kategori'));
        $show->field('deskripsi', __('Deskripsi'));
        // $show->field('created_at', __('Created at'));
        // $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Kategori_produk());

        $form->text('nama_kategori', __('Nama kategori'));
        $form->text('deskripsi', __('Deskripsi'));

        return $form;
    }
}
