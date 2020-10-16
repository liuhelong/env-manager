<?php

namespace Liuhelong\laravelAdmin\EnvManager\Http\Controllers;


use App\Http\Controllers\Controller;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Show;
use Liuhelong\laravelAdmin\EnvManager\Env;


class EnvManagerController extends Controller
{
    use HasResourceActions;

    public function index(Content $content)
    {
        return $content
            ->header('核心配置')
            ->description('请谨慎修改/删除')
            ->body($this->grid());
    }


    /**
     * Show interface.
     *
     * @param mixed $key
     * @param Content $content
     * @return Content
     */
    public function show($key, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('请谨慎修改/删除')
            ->body($this->detail($key));
    }


    /**
     * Edit interface.
     *
     * @param $key
     * @return Content
     */
    public function edit($key, Content $content)
    {
        $content->header('核心配置');
        $content->description('请谨慎修改/删除');
        $content->body($this->form()->edit($key));
        return $content;
    }


    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Env());
        $grid->key();
        $grid->value();
        $grid->column('remark',__('laravel_admin.Remark'));
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $key
     * @return Show
     */
    protected function detail($key)
    {
        $env = new Env();
        $show = new Show($env->findOrFail($key));

        $show->key('Key');
        $show->value('Value');

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Env());
        $form->display('key', __('laravel_admin.Key'));
        $form->text('value', __('laravel_admin.Value'));
        $form->text('remark',__('laravel_admin.Remark'));
        return $form;
    }


}
