<?php

namespace App\Http\Controllers;

use App\Ban;
use App\Business;
use App\Car;
use App\Group;
use App\House;
use App\Update;
use App\User;
use App\War;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::count();
        $houses = House::count();
        $cars = Car::count();
        $businesses = Business::count();

        $logs = DB::table('log_team_player')
            ->orderBy('log_date')
            ->limit(10)
            ->get();

        $update = Update::orderByDesc('id')->first();

        return view('app.home', compact('users', 'houses', 'cars', 'businesses', 'logs', 'update'));
    }

    public function online(){
        $users = User::where('player_in_game_id', '>', '-1')->orderBy('player_team')->get();

        return view('app.online', compact('users'));
    }

    public function staff(){
        $admins = User::where('player_admin', '>', '0')->orderByDesc('player_admin')->get();

        $helpers = User::where('player_helper', '>', '0')->orderByDesc('player_helper')->get();

        $leaders = User::where('player_team_rank', '=', '7')->orderBy('player_team', 'asc')->get();

        return view('app.staff', compact('admins', 'helpers', 'leaders'));
    }

    public function searchPlayer(){
        return view('app.searchPlayer');
    }

    public function search(Request $request){
        $users = User::where('player_name', 'LIKE', '%'.$request['name'].'%')->orderBy('player_level', 'desc')->paginate(50);
        return view('app.search', compact('users'));
    }

    public function profile($username){
        $user = User::where('player_name', '=', $username)->firstOrFail();;

        $logs = DB::table('log_team_player')
            ->where('player_name', '=', $username)
            ->orderBy('log_date', 'desc')
            ->get();

        $cars = $user->cars()->get();

        $ban = Ban::where('player_name', '=', $username)->first();
        return view('app.profile', compact('user', 'logs', 'cars', 'ban'));
    }



    public function businesses(){
        $businesses = Business::all();
        return view('app.businesses', compact('businesses'));
    }

    public function houses(){
        $houses = House::paginate(20);
        return view('app.houses', compact('houses'));
    }
    public function topPlayers(){
        $users = User::orderByDesc('player_hours')->limit(50)->get();
        return view('app.topPlayers', compact('users'));
    }
    public function banList(){
        $bans = Ban::orderBy('ban_id', 'desc')->paginate(15);

        return view('app.banlist', compact('bans'));
    }

    public function wars(){
        $logs = War::orderByDesc('date')->paginate(20);

        return view('app.wars', compact('logs'));
    }

    public function terms(){
        return view('app.terms');
    }

    public function privacy(){
        return view('app.privacy');
    }

    public function war($id){

        $war = War::findOrFail($id);


        $attackers = DB::table('log_war_player')
            ->where('war_id', '=', $id)
            ->where('faction', '=', $war->attacker_id)
            ->orderBy('kills','desc')
            ->orderBy('deaths','asc')
            ->get();

        $defenders = DB::table('log_war_player')
            ->where('war_id', '=', $id)
            ->where('faction', '=', $war->defender_id)
            ->orderBy('kills','desc')
            ->orderBy('deaths','asc')
            ->get();


        return view('app.war', compact('players','attackers','defenders', 'war'));
    }

    public function dealership(){
        $vehicleName = Array(
            400 => 'landstalker', 401 => 'bravura', 402 => 'buffalo', 403 => 'linerunner', 404 => 'perenail', 405 => 'sentinel', 406 => 'dumper', 407 => 'firetruck', 408 => 'trashmaster', 409 => 'stretch', 410 => 'manana', 411 => 'infernus', 412 => 'voodoo', 413 => 'pony', 414 => 'mule', 415 => 'cheetah', 416 => 'ambulance', 417 => 'levetian', 418 => 'moonbeam', 419 => 'esperanto', 420 => 'taxi', 421 => 'washington', 422 => 'bobcat', 423 => 'mr whoopee', 424 => 'bf injection', 425 => 'hunter', 426 => 'premier', 427 => 'enforcer', 428 => 'securicar', 429 => 'banshee', 430 => 'predator', 431 => 'bus', 432 => 'rhino', 433 => 'barracks', 434 => 'hotknife', 435 => 'artic trailer 1', 436 => 'previon', 437 => 'coach', 438 => 'cabbie', 439 => 'stallion', 440 => 'rumpo', 441 => 'rc bandit',
            442 => 'romero', 443 => 'packer', 444 => 'monster', 445 => 'admiral', 446 => 'squalo', 447 => 'seasparrow', 448 => 'pizza boy', 449 => 'tram', 450 => 'artic trailer 2', 451 => 'turismo', 452 => 'speeder', 453 => 'reefer', 454 => 'tropic', 455 => 'flatbed', 456 => 'yankee', 457 => 'caddy', 458 => 'solair', 459 => 'top fun', 460 => 'skimmer', 461 => 'pcj 600', 462 => 'faggio', 463 => 'freeway', 464 => 'rc baron', 465 => 'rc raider', 466 => 'glendale', 467 => 'oceanic', 468 => 'sanchez', 469 => 'sparrow', 470 => 'patriot', 471 => 'quad', 472 => 'coastgaurd', 473 => 'dinghy', 474 => 'hermes', 475 => 'sabre', 476 => 'rustler', 477 => 'zr 350', 478 => 'walton', 479 => 'regina', 480 => 'comet', 481 => 'bmx', 482 => 'burriro', 483 => 'camper', 484 => 'marquis', 485 => 'baggage',
            486 => 'dozer', 487 => 'maverick', 488 => 'vcn maverick', 489 => 'rancher', 490 => 'fbi rancher', 491 => 'virgo', 492 => 'greenwood', 493 => 'jetmax', 494 => 'hotring', 495 => 'sandking', 496 => 'blistac', 497 => 'police maverick', 498 => 'boxville', 499 => 'benson', 500 => 'mesa', 501 => 'rc goblin', 502 => 'hotring a', 503 => 'hotring b', 504 => 'blood ring banger', 505 => 'rancher (lure)', 506 => 'super gt', 507 => 'elegant', 508 => 'journey', 509 => 'bike', 510 => 'mountain bike', 511 => 'beagle', 512 => 'cropduster', 513 => 'stuntplane', 514 => 'petrol', 515 => 'roadtrain', 516 => 'nebula', 517 => 'majestic', 518 => 'buccaneer', 519 => 'shamal', 520 => 'hydra', 521 => 'fcr 900', 522 => 'nrg 500', 523 => 'hpv 1000', 524 => 'cement', 525 => 'towtruck', 526 => 'fortune',
            527 => 'cadrona', 528 => 'fbi truck', 529 => 'williard', 530 => 'fork lift', 531 => 'tractor', 532 => 'combine', 533 => 'feltzer', 534 => 'remington', 535 => 'slamvan', 536 => 'blade', 537 => 'freight', 538 => 'streak', 539 => 'vortex', 540 => 'vincent', 541 => 'bullet', 542 => 'clover', 543 => 'sadler', 544 => 'firetruck la', 545 => 'hustler', 546 => 'intruder', 547 => 'primo', 548 => 'cargobob', 549 => 'tampa', 550 => 'sunrise', 551 => 'merit', 552 => 'utility van', 553 => 'nevada', 554 => 'yosemite', 555 => 'windsor', 556 => 'monster a', 557 => 'monster b', 558 => 'uranus', 559 => 'jester', 560 => 'sultan', 561 => 'stratum', 562 => 'elegy', 563 => 'raindance', 564 => 'rc tiger', 565 => 'flash', 566 => 'tahoma', 567 => 'savanna', 568 => 'bandito', 569 => 'freight flat',
            570 => 'streak', 571 => 'kart', 572 => 'mower', 573 => 'duneride', 574 => 'sweeper', 575 => 'broadway', 576 => 'tornado', 577 => 'at 400', 578 => 'dft 30', 579 => 'huntley', 580 => 'stafford', 581 => 'bf 400', 582 => 'news van', 583 => 'tug', 584 => 'petrol tanker', 585 => 'emperor', 586 => 'wayfarer', 587 => 'euros', 588 => 'hotdog', 589 => 'club', 590 => 'freight box', 591 => 'artic trailer 3', 592 => 'andromada', 593 => 'dodo', 594 => 'rc cam', 595 => 'launch', 596 => 'cop car ls', 597 => 'cop car sf', 598 => 'cop car lv', 599 => 'ranger', 600 => 'picador', 601 => 'swat tank', 602 => 'alpha', 603 => 'phoenix', 604 => 'glendale (damage)', 605 => 'sadler (damage)', 606 => 'bag box a', 607 => 'bag box b', 608 => 'stairs', 609 => 'boxville (black)', 610 => 'farm trailer', 611 => 'utility van trailer'
        );
        $vehicles = DB::table('dealership')->orderBy('type', 'asc')->orderBy('price', 'asc')->get();
        return view('app.dealership', compact('vehicles','vehicleName'));
    }

    public function serverUpdates(){
        $updates = Update::all();
        return view('app.updates', compact('updates'));
    }
}
