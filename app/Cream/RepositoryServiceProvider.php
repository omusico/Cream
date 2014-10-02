<?php namespace Cream;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    public function register()
    {
        // $this->userBindings();
        $this->entityBindings();
        $this->configBindings();
        // $this->ajaxBindings();
        // $this->miscBindings();
    }

    protected function userBindings()
    {
        $this->app->bind('Cream\User\Repositories\UserRepositoryInterface', 'Cream\User\Repositories\UserRepository');
        $this->app->bind('Cream\User\Repositories\RoleRepositoryInterface', 'Cream\User\Repositories\RoleRepository');
    }

    protected function entityBindings()
    {
        $this->app->bind('Lion\Repositories\Company\CompanyRepositoryInterface',            'Lion\Repositories\Company\CompanyRepository');
        $this->app->bind('Lion\Repositories\People\PeopleRepositoryInterface',              'Lion\Repositories\People\PeopleRepository');
        $this->app->bind('Lion\Repositories\Deal\DealRepositoryInterface',                  'Lion\Repositories\Deal\DealRepository');
        // $this->app->bind('Cream\Company\Repositories\CompanyRepositoryInterface', 'Cream\Company\Repositories\CompanyRepository');
        // $this->app->bind('Cream\People\Repositories\PeopleRepositoryInterface', 'Cream\People\Repositories\PeopleRepository');
        // $this->app->bind('Cream\Deal\Repositories\DealRepositoryInterface', 'Cream\Deal\Repositories\DealRepository');
        // $this->app->bind('Cream\Action\Repositories\ActionRepositoryInterface', 'Cream\Action\Repositories\ActionRepository');
    }

    protected function configBindings()
    {
        $this->app->bind('Lion\Repositories\Config\Stage\StageConfigRepositoryInterface',               'Lion\Repositories\Config\Stage\StageConfigRepository');
        $this->app->bind('Lion\Repositories\Config\Source\SourceConfigRepositoryInterface',             'Lion\Repositories\Config\Source\SourceConfigRepository');
        $this->app->bind('Lion\Repositories\Config\Status\StatusConfigRepositoryInterface',             'Lion\Repositories\Config\Status\StatusConfigRepository');
        $this->app->bind('Lion\Repositories\Config\Activities\ActivitiesConfigRepositoryInterface',     'Lion\Repositories\Config\Activities\ActivitiesConfigRepository');
        $this->app->bind('Lion\Repositories\Config\ActionType\ActionTypeConfigRepositoryInterface',     'Lion\Repositories\Config\ActionType\ActionTypeConfigRepository');

        // $this->app->bind('Cream\Config\Repositories\Interfaces\StatusConfigRepositoryInterface', 'Cream\Config\Repositories\StatusConfigRepository');
        // $this->app->bind('Cream\Config\Repositories\Interfaces\StagesConfigRepositoryInterface', 'Cream\Config\Repositories\StagesConfigRepository');
        // $this->app->bind('Cream\Config\Repositories\Interfaces\AccountConfigRepositoryInterface', 'Cream\Config\Repositories\AccountConfigRepository');
        // $this->app->bind('Cream\Config\Repositories\Interfaces\DocumentsConfigRepositoryInterface', 'Cream\Config\Repositories\DocumentsConfigRepository');
        // $this->app->bind('Cream\Config\Repositories\Interfaces\LabelsConfigRepositoryInterface', 'Cream\Config\Repositories\LabelsConfigRepository');
        // $this->app->bind('Cream\Config\Repositories\Interfaces\ActionTypesConfigRepositoryInterface', 'Cream\Config\Repositories\ActionTypesConfigRepository');
        // $this->app->bind('Cream\Config\Repositories\Interfaces\SourcesConfigRepositoryInterface', 'Cream\Config\Repositories\SourcesConfigRepository');
        // 
        // 
        // $this->app->bind('Cream\Config\ActionResult\Repositories\VisitResultRepositoryInterface', 'Cream\Config\ActionResult\Repositories\VisitResultRepository');
        // $this->app->bind('Cream\Config\ActionResult\Repositories\EmailResultRepositoryInterface', 'Cream\Config\ActionResult\Repositories\EmailResultRepository');
        // $this->app->bind('Cream\Config\ActionResult\Repositories\CallResultRepositoryInterface', 'Cream\Config\ActionResult\Repositories\CallResultRepository');
        // $this->app->bind('Cream\Config\PeopleSalutation\Repositories\PeopleSalutationRepositoryInterface', 'Cream\Config\PeopleSalutation\Repositories\PeopleSalutationRepository');

    }

    protected function ajaxBindings()
    {
        $this->app->bind('Cream\Company\Repositories\CompanyAjaxRepositoryInterface', 'Cream\Company\Repositories\CompanyAjaxRepository');
        $this->app->bind('Cream\Action\Repositories\ActionAjaxRepositoryInterface', 'Cream\Action\Repositories\ActionAjaxRepository');
    }

    protected function miscBindings()
    {
        $this->app->bind('Cream\Misc\Repositories\TagsAjaxRepositoryInterface', 'Cream\Misc\Repositories\TagsAjaxRepository');
    }

}