<?php

namespace App\Providers;

use App\Interface\TagInterface;
use App\Interface\UntiIntrerface;
use App\Repository\TagRepository;
use App\Repository\UnitRepository;
use App\Interface\City\CityInterface;
use App\Interface\PortfolioInterface;
use App\Repository\ProductRepository;
use App\Interface\Gates\GatesInterface;
use App\Interface\State\StateInterface;
use App\Repository\City\CityRepository;
use App\Repository\PortfolioRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\Gates\GatesRepository;
use App\Repository\State\StateRepository;
use App\Interface\BrokerProductIntrerface;
use App\Interface\Country\CountryInterface;
use App\Interface\Package\PackageInterface;
use App\Interface\Project\ProjectInterface;
use App\Repository\BrokerProductRepository;
use App\Interface\Category\CategoryInterface;
use App\Interface\District\DistrictInterface;
use App\Repository\Country\CountryRepository;
use App\Repository\Package\PackageRepository;
use App\Repository\Project\ProjectRepository;
use App\Repository\Category\CategoryRepository;
use App\Repository\District\DistrictRepository;

class RepositroyProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UntiIntrerface::class,UnitRepository::class);
        $this->app->bind(BrokerProductIntrerface::class,BrokerProductRepository::class);
        $this->app->bind(CategoryInterface::class,CategoryRepository::class);
        $this->app->bind(CountryInterface::class,CountryRepository::class);
        $this->app->bind(StateInterface::class,StateRepository::class);
        $this->app->bind(CityInterface::class,CityRepository::class);
        $this->app->bind(DistrictInterface::class,DistrictRepository::class);
        $this->app->bind(PackageInterface::class,PackageRepository::class);
        $this->app->bind(ProjectInterface::class,ProjectRepository::class);
        $this->app->bind(GatesInterface::class,GatesRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
