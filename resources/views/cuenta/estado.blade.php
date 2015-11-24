


{{--*/ 
$year = array(2013,2014,2015,2016);
$month = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 /*--}}



  <ul class="nav nav-tabs">
    <li><a href="#2013">2013</a></li>
    <li><a href="#2014">2014</a></li>
    <li class="active"><a href="#2015">2015</a></li>
    <li><a href="#2016">2016</a></li>
  </ul>
       <br>
  <div class="tab-content">

    <div id="2015" class="tab-pane fade in active">

      <ul class="nav nav-tabs">
              {{--*/ 
                for ($k = 0; $k < 12; $k++) {
                echo "<li><a href='#" .$month[$k]."'>".$month[$k]."</a></li>";
                  }
              /*--}}
      </ul>

          {{--*/ for ($q = 0; $q < 12; $q++) {

              if($q==10)
                  echo "<div id='" . $month[$q] . "' class='tab-pane fade in active'>";
                else
                  echo "<div id='" . $month[$q] . "' class='tab-pane fade'>"; 

                /*--}}

                <br>
               
              
               <br>

 @foreach($pagos as $pago)
  @if($pago->id_user == Auth::user()->id)
    {{--*/ $date = explode("-", $pago->date) /*--}}
    @if($date[1] == ($q+1))
        <table class='table table-condensed'>
                <tbody>
                  <tr>
                    <td><strong>Fecha:</strong></td>
                    <td>{{$pago->date}}</td>
                  </tr>
                  <tr>
                    <td><strong>Cliente:</strong></td>
                    <td>{{Auth::user()->name}}</td>
                  </tr>
                  <tr>
                    <td><strong>Dirección:</strong></td>
                    <td>{{Auth::user()->address}}</td>
                  </tr>
                </tbody>
               </table>

               <table class='table table-condensed'>
                <thead>
                  <tr>
                    <th>Concepto</th>
                    <th>Precio Unitario</th>
                    <th>Descuento</th>
                    <th>Importe</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><p>Aportación</p></td>
                    <td>$500.00</td>
                    <td>0%</td>
                    <td>{{'$ '. number_format($pago->amount, 2) }}</td>
                  </tr>
                </tbody>
              </table>
             
    @endif
  @endif
@endforeach
               
              </div>
           {{--*/  }  /*--}}
    </div>
  </div>

  <style>
.fade {
    display: none !important;
}
.fade.in {
    display: block !important;
}
</style>





