@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading ">Pregled prijava</div>

                <div class="panel-body">
                     <div id="winners"><ol></ol></div>
                      <button type="button" class="btn btn-block btn-large btn-primary" id="random_location">Odaberi osobu</button>
                    <div id="slot_wrapper">
    <input type="text" class="search">
    <ul id="slot">
      <!-- Initial list needs the height it will have when filled for jSlots to run correctly. You could fill with real values instead -->
      <li>test</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li>
    </ul>
</div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>

$(document).ready(function(){

  var msa = [

  @foreach ($randomusers as  $index => $prijava)
      { name: "{{ $prijava->first_name }} {{ $prijava->last_name }}"}, 
  @endforeach

      { name: "Abilene, TX" },
      /*
      { name: "Akron, OH" },
      { name: "Albany, GA" },
      { name: "Albany, OR" },
      { name: "Albany-Schenectady-Troy, NY" },
      { name: "Albuquerque, NM" },
      { name: "Alexandria, LA" },
      { name: "Allentown-Bethlehem-Easton, PA-NJ" },
      { name: "Altoona, PA" },
      { name: "Amarillo, TX" },
      { name: "Ames, IA" },
      { name: "Anchorage, AK" },
      { name: "Ann Arbor, MI" },
      { name: "Anniston-Oxford-Jacksonville, AL" },
      { name: "Appleton, WI" },
      { name: "Asheville, NC" },
      { name: "Athens-Clarke County, GA" },
      { name: "Atlanta-Sandy Springs-Roswell, GA" },
      { name: "Atlantic City-Hammonton, NJ" },
      { name: "Auburn-Opelika, AL" },
      { name: "Augusta-Richmond County, GA-SC" },
      { name: "Austin-Round Rock, TX" },
      { name: "Bakersfield, CA" },
      { name: "Baltimore-Columbia-Towson, MD" },
      { name: "Bangor, ME" },
      { name: "Barnstable Town, MA" },
      { name: "Baton Rouge, LA" },
      { name: "Battle Creek, MI" },
      { name: "Bay City, MI" },
      { name: "Beaumont-Port Arthur, TX" },
      { name: "Beckley, WV" },
      { name: "Bellingham, WA" },
      { name: "Bend-Redmond, OR" },
      { name: "Billings, MT" },
      { name: "Binghamton, NY" },
      { name: "Birmingham-Hoover, AL" },
      { name: "Bismarck, ND" },
      { name: "Blacksburg-Christiansburg-Radford, VA" },
      { name: "Bloomington, IL" },
      { name: "Bloomington, IN" },
      { name: "Bloomsburg-Berwick, PA" },
      { name: "Boise City, ID" },
      { name: "Boston-Cambridge-Newton, MA-NH" },
      { name: "Boulder, CO" },
      { name: "Bowling Green, KY" },
      { name: "Bremerton-Silverdale, WA" },
      { name: "Bridgeport-Stamford-Norwalk, CT" }
      */
    ],
    $input = $('input'),
    random_index;


    function makeSlotList(list){
          $('#random_location').hide();
        if(list.length<20){
            var index = _.random(msa.length-1);
            if(list.length===1){
                random_index = index;
               
                //$('#slot').html(list.join('')).parent().show().trigger('spin');
               // return list;
            }
            if (msa[index]=== undefined){
                 $input.val('Nema više:(');
                 return;
            }
            
            list.push( '<li index='+_.random(msa.length-1)+'>'+msa[index].name+'</li>' );
            return makeSlotList(list);
        } else {

            $input.val('');
            $('#slot').html(list.join('')).parent().show().trigger('spin');
            return list;
        }
    }

    //before spinning, build out list to spin through and insert into the DOM
    function makeSlots(){
        //start with current value
        var list = ['<li>'+$input.val()+'</li>'];

        //call recursive list builder that won't spin slots until it's finished
        makeSlotList(list);
    }

    $('#slot').jSlots({
        number: 1,
        spinner : '.jSlots-wrapper',
        spinEvent: 'spin',
        time: 400,
        loops: 1,
        endNum: 2,//spins backwards through the list. endNum 1 ends on the same value we started on
        onEnd: function(finalElement){
            //set result
            $input.val(msa[random_index].name);
             $('#winners ol').append('<li>'+msa[random_index].name+'</li>');
            msa.splice(random_index,1); 
            //hide spinner
            $(this.spinner).hide();
            $('#random_location').show();
           
        }
    });

    //bind random button
    $('#random_location').on('click', makeSlots);
});

</script>

<style>
  * { box-sizing: border-box; }
  li, ul { padding: 0; margin:0; }
  input {
    margin: 4px 0;
    margin: 40px 0;
    border: none;  
    font-size: 48px;
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
    padding: 5px 4px 4px;
    height: 460px;
    width: 650px;
    width: 100%;
  }
  #slot li {
  
    font-size: 48px;
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
    padding: 6px 4px 6px 6px;
    line-height: normal;
    height: 460px;
    overflow: hidden;
  }
  #slot_wrapper {
    position: relative;
  }
  .jSlots-wrapper {
    margin: 4px 0;
    margin: 40px 0;
      overflow: hidden; /* to hide the magic */
      height: 459px; /* whatever the height of your list items are */
      width: 650px;
      width: 100%;
      position: absolute;
      top: 0px;
      display: none;
  }
  #slot {
    display: none;
  }
</style>

<script>
@endsection
