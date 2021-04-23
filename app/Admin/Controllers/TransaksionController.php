<?php

namespace App\Admin\Controllers;

use Illuminate\Support\MessageBag;
use App\Transaksion;
use App\Produk;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TransaksionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Transaksion';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Transaksion());

        $grid->column('id', __('Id'));
        $grid->column('produk_id', __('Produk id'));
        $grid->column('nama', __('Nama'));
        // $grid->column('stok_in', __('Stok in'));
        $grid->column('stok_out', __('Stok out'));
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
        $show = new Show(Transaksion::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('produk_id', __('Produk id'));
        $show->field('nama', __('Nama'));
        $show->field('stok_in', __('Stok in'));
        $show->field('stok_out', __('Stok out'));
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
        $form = new Form(new Transaksion());

        // $form->number('produk_id', __('Produk id'));
        // $form->select('produk_id'['produk'])->options([$atribut]);
        $form->select('produk_id')->options(function ($id) {
            $produk = Produk::all();
            $atribut = [];
            for ($i = 0; $i < count($produk); $i++) {
                $id = $produk[$i]->id;
                $nama = $produk[$i]->nama;

                $atribut[$id] = $nama;
            }
            return $atribut;
        });
        $form->text('nama', __('Nama'));
        // $form->number('stok_in', __('Stok in'));
        $form->number('stok_out', __('Stok out'));
        $form->saving(function (Form $form) {
            //...
            $id = $form->produk_id;
            $jumlah = $form->stok_out;
            $update_stok = $this->updateStok($id, false, $jumlah);
            if (!$update_stok) {
                $error = new MessageBag([
                    'title'   => 'title...',
                    'message' => 'Stok tidak mencukupi',
                ]);

                return back()->with(compact('error'));
            }
        });


        return $form;
    }

    protected function updateStok($id, $bertambah, $jumlah)
    {
        $produk = Produk::find($id);

        if ($produk->stok < $jumlah) {
            return false;
        }

        if ($bertambah) {
            $produk->stok = $produk->stok + $jumlah;
        } else {
            $produk->stok = $produk->stok - $jumlah;
        }
        $produk->save();
        return true;
    }
}
