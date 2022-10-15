<a class="cotation-row" href="{{ $link }}" target="_blank">
  <img src="/assets/img/{{ $idSellercentral }}.png" alt="">
  <div>@if($company == "general"){{ $sellercentral }}@else{{ $company }}@endif</div>
  <div>R$ @if(isset($price) && $price != "0.00"){{ preg_replace("/\./", ",", $price) }}@else{{ '----' }}@endif</div>
</a>
