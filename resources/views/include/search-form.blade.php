<?php

use App\components\Shared;

?>

<div class="container hidden-xs"  >

    <div class="search">

        <div class="container">

            <div class="row">

                <div class="col-md-10 col-md-offset-1">

                    <div class=" col-md-6 col-md-offset-3" style=" 

                        text-align: center; margin-bottom: 4px;

                        font-style: italic;" ><b style="

                        color: #fff;

                        font-weight: 500;

                        font-size: 40px;

                        text-shadow: 1px 0px 20px;">Your journey starts here! </b>

                    </div>

                    <div class="clear"></div>

                    <div class="form-section">

                        <div class="row">

                            <form action="/search">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <div class="serchtile">Where would you like to go?</div>

                                        <label class="sr-only" for="looking">Where would you like to go?</label>

                                        <input class="w3-input w3-border w3-padding" name="sc" type="text" placeholder="Where would you like to go... [ City Name ]" id="myInput" 

                                        onkeyup="SearchCity()" required="">

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">

                                        <div class="serchtile">Holiday Types</div>

                                        <label class="sr-only" for="religion">Distination</label>

                                        <select name="type" class="w3-input w3-border w3-padding">

                                            @foreach(\App\HolidayType::where('web' , 1)->orderBy('name')->get() as $cat )

                                                <option value="{{$cat->id}}">{{$cat->name}}</option>

                                            @endforeach

                                        </select>

                                    </div>

                                </div>

                                <div class="col-md-2">

                                    <br>

                                    <button type="submit" class="btn btn-default btn-primary">Search</button>

                                </div>

                            </form>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-10">

                            <div class="col-md-12">

                                <div class="row">

                                    <div class="search-resutl">

                                        <div class="w3-containe">

                                            <div class="col-md-12">

                                                <ul class="list-group" id="myUL">

                                                </ul>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>        

    </div>

</div>

