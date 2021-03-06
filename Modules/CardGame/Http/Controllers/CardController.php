<?php

namespace Modules\CardGame\Http\Controllers;

use Illuminate\View\View;
use App\Http\Controllers\BaseController;
use Modules\CardGame\Http\Entities\Card;
use Modules\CardGame\Http\Entities\Race;
use Modules\CardGame\Http\Entities\Rarity;
use Modules\CardGame\Http\Entities\CardSet;
use Modules\CardGame\Http\Entities\Ability;
use Modules\CardGame\Http\Entities\CardType;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CardController extends BaseController
{
    /**
     * @var Card
     */
    protected $model;
    /**
     * @var CardSet
     */
    private $cardSet;
    /**
     * @var Race
     */
    private $race;
    /**
     * @var Ability
     */
    private $ability;
    /**
     * @var CardType
     */
    private $cardType;
    /**
     * @var Rarity
     */
    private $rarity;

    /**
     * @param Card     $card
     * @param CardSet  $cardSet
     * @param Race     $race
     * @param Ability  $ability
     * @param CardType $cardType
     * @param Rarity   $rarity
     */
    public function __construct(
        Card $card,
        CardSet $cardSet,
        Race $race,
        Ability $ability,
        CardType $cardType,
        Rarity $rarity
    )
    {
        parent::__construct();

        $this->model = $card;
        $this->cardSet = $cardSet;
        $this->race = $race;
        $this->ability = $ability;
        $this->cardType = $cardType;
        $this->rarity = $rarity;
    }

    public function index()
    {
        return view('cardgame::card.index', [
            'nameRoute' => 'card',
            'counts' => $this->model->getCountsWithEnergy(),
            'entities' => $this->model->withTrashedAll(Card::SORT_ENERGY),
            'cardSets' => $this->cardSet->getAll(),
            'races' => $this->race->getAll(),
            'abilities' => $this->ability->getAll(),
            'types' => $this->cardType->getAll(),
            'rarities' => $this->rarity->getAll(),
        ]);
    }

    /**
     * @var int $id
     *
     * @return View | HttpException
     */
    public function edit($id)
    {
        return view('cardgame::card.update', [
            'entity' => parent::edit($id),
            'cardSets' => $this->cardSet->getAll(),
            'races' => $this->race->getAll(),
            'abilities' => $this->ability->getAll(),
            'types' => $this->cardType->getAll(),
            'rarities' => $this->rarity->getAll(),
        ]);
    }
}
