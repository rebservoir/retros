
  <ul class="nav nav-tabs">
    <li><a href="#2013">2013</a></li>
    <li><a href="#2014">2014</a></li>
    <li class="active"><a href="#2015">2015</a></li>
    <li><a href="#2016">2016</a></li>
  </ul>
 
  <div class="tab-content">
    <div id="2015" class="tab-pane fade in active">
      <br>
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td class="success">Enero</td>
              <td class="success">Febrero</td>
              <td class="success">Marzo</td>
              <td class="success">Abril</td>
              <td class="success">Mayo</td>
              <td class="success">Junio</td>
            </tr>

            <tr>
              @foreach($pagos as $pago)
                {{--*/ $date = explode("-", $pago->date) /*--}}
                @if( ($pago->id_user == 7) && ($date[1]==1) ) 
                  <td>{{$pago->amount}}</td>
                @endif
              @endforeach

              @foreach($pagos as $pago)
                {{--*/ $date = explode("-", $pago->date) /*--}}
                @if( ($pago->id_user == 7) && ($date[1]==2) ) 
                  <td>{{$pago->amount}}</td>
                @endif
              @endforeach

              @foreach($pagos as $pago)
                {{--*/ $date = explode("-", $pago->date) /*--}}
                @if( ($pago->id_user == 7) && ($date[1]==3) ) 
                  <td>{{$pago->amount}}</td>
                @endif
              @endforeach

              @foreach($pagos as $pago)
                {{--*/ $date = explode("-", $pago->date) /*--}}
                @if( ($pago->id_user == 7) && ($date[1]==4) ) 
                  <td>{{$pago->amount}}</td>
                @endif
              @endforeach

              @foreach($pagos as $pago)
                {{--*/ $date = explode("-", $pago->date) /*--}}
                @if( ($pago->id_user == 7) && ($date[1]==5) ) 
                  <td>{{$pago->amount}}</td>
                @endif
              @endforeach

              @foreach($pagos as $pago)
                {{--*/ $date = explode("-", $pago->date) /*--}}
                @if( ($pago->id_user == 7) && ($date[1]==6) ) 
                  <td>{{$pago->amount}}</td>
                @endif
              @endforeach
            </tr>

            <tr>
              <td class="success">Julio</td>
              <td class="success">Agosto</td>
              <td class="danger">Septiembre</td>
              <td class="danger">Octubre</td>
              <td class="">Noviembre</td>
              <td class="">Diciembre</td>
            </tr>

            <tr>
             @foreach($pagos as $pago)
                {{--*/ $date = explode("-", $pago->date) /*--}}
                @if( ($pago->id_user == 7) && ($date[1]==7) ) 
                  <td>{{$pago->amount}}</td>
                @endif
              @endforeach

              @foreach($pagos as $pago)
                {{--*/ $date = explode("-", $pago->date) /*--}}
                @if( ($pago->id_user == 7) && ($date[1]==8) ) 
                  <td>{{$pago->amount}}</td>
                @endif
              @endforeach

              @foreach($pagos as $pago)
                {{--*/ $date = explode("-", $pago->date) /*--}}
                @if( ($pago->id_user == 7) && ($date[1]==9) ) 
                  <td>{{$pago->amount}}</td>
                @endif
              @endforeach

              @foreach($pagos as $pago)
                {{--*/ $date = explode("-", $pago->date) /*--}}
                @if( ($pago->id_user == 7) && ($date[1]==10) ) 
                  <td>{{$pago->amount}}</td>
                @endif
              @endforeach

              @foreach($pagos as $pago)
                {{--*/ $date = explode("-", $pago->date) /*--}}
                @if( ($pago->id_user == 7) && ($date[1]==11) ) 
                  <td>{{$pago->amount}}</td>
                @endif
              @endforeach

              @foreach($pagos as $pago)
                {{--*/ $date = explode("-", $pago->date) /*--}}
                @if( ($pago->id_user == 7) && ($date[1]==12) ) 
                  <td>{{$pago->amount}}</td>
                @endif
              @endforeach
            </tr>
            
            
            
          </tbody>
        </table>
    </div>
  </div>

