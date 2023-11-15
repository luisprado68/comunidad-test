@extends('layouts.app')

@section('content')
    <div class="container mt-5 ">
        <div class="row">
            @if (session()->has('user') && session('status') == 0)
                @include('link')
            @else
                <div class="d-flex justify-content-center">
                    <div class="card w-50 bg-secondary">

                        <div class="card-body bg-secondary m-0 p-0">
                            <div class="card bg-black ">
                                <h5 class="card-title mt-2  text-center text-light ">Edita tu Perfil</h5>
                            </div>

                            <div class="row justify-content-center">

                                <div class="col-8 mb-3 mt-3">
                                    <label class="block mb-2 text-sm font-medium text-white" for="channel">Canal</label>
                                    <input type="text" class="form-control" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default" value="{{ $user->channel }}">
                                </div>
                                <div class="col-8 mb-3 mt-3">
                                    <label class="block mb-2 text-sm font-medium text-white" for="channel">Nombre
                                        Completo</label>
                                    <input type="text" class="form-control" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default" value="{{ $user->name }}">
                                </div>
                                <div class="col-8 mb-3">
                                    <label class="block mb-2 text-sm font-medium text-white" for="channel">País</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Elige una opción</option>
                                        @foreach ( $countries as $country )
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                 
                                </div>

                                <div class="row " style="margin-right:10px">
                                    <div class="col-2 offset-2 mb-3">
                                        <label class="block mb-2 text-sm font-medium text-white"
                                            for="channel">Teléfono</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Elige una opción </option>
                                            <option value="+1">+1 (🇨🇦)</option>
                                            <option value="+1">+1 (🇺🇸)</option>
                                            <option value="+7">+7 (🇰🇿)</option>
                                            <option value="+7">+7 (🇷🇺)</option>
                                            <option value="+20">+20 (🇪🇬)</option>
                                            <option value="+27">+27 (🇿🇦)</option>
                                            <option value="+30">+30 (🇬🇷)</option>
                                            <option value="+31">+31 (🇳🇱)</option>
                                            <option value="+32">+32 (🇧🇪)</option>
                                            <option value="+33">+33 (🇫🇷)</option>
                                            <option value="+34">+34 (🇪🇸)</option>
                                            <option value="+36">+36 (🇭🇺)</option>
                                            <option value="+39">+39 (🇮🇹)</option>
                                            <option value="+40">+40 (🇷🇴)</option>
                                            <option value="+41">+41 (🇨🇭)</option>
                                            <option value="+43">+43 (🇦🇹)</option>
                                            <option value="+44">+44 (🇬🇬)</option>
                                            <option value="+44">+44 (🇮🇲)</option>
                                            <option value="+44">+44 (🇯🇪)</option>
                                            <option value="+44">+44 (🇬🇧)</option>
                                            <option value="+45">+45 (🇩🇰)</option>
                                            <option value="+46">+46 (🇸🇪)</option>
                                            <option value="+47">+47 (🇧🇻)</option>
                                            <option value="+47">+47 (🇳🇴)</option>
                                            <option value="+47">+47 (🇸🇯)</option>
                                            <option value="+48">+48 (🇵🇱)</option>
                                            <option value="+49">+49 (🇩🇪)</option>
                                            <option value="+51">+51 (🇵🇪)</option>
                                            <option value="+52">+52 (🇲🇽)</option>
                                            <option value="+53">+53 (🇨🇺)</option>
                                            <option value="+54">+54 (🇦🇷)</option>
                                            <option value="+55">+55 (🇧🇷)</option>
                                            <option value="+56">+56 (🇨🇱)</option>
                                            <option value="+57">+57 (🇨🇴)</option>
                                            <option value="+58">+58 (🇻🇪)</option>
                                            <option value="+60">+60 (🇲🇾)</option>
                                            <option value="+61">+61 (🇦🇺)</option>
                                            <option value="+61">+61 (🇨🇽)</option>
                                            <option value="+61">+61 (🇨🇨)</option>
                                            <option value="+62">+62 (🇮🇩)</option>
                                            <option value="+63">+63 (🇵🇭)</option>
                                            <option value="+64">+64 (🇳🇿)</option>
                                            <option value="+64">+64 (🇵🇳)</option>
                                            <option value="+65">+65 (🇸🇬)</option>
                                            <option value="+66">+66 (🇹🇭)</option>
                                            <option value="+81">+81 (🇯🇵)</option>
                                            <option value="+82">+82 (🇰🇷)</option>
                                            <option value="+84">+84 (🇻🇳)</option>
                                            <option value="+86">+86 (🇨🇳)</option>
                                            <option value="+90">+90 (🇹🇷)</option>
                                            <option value="+91">+91 (🇮🇳)</option>
                                            <option value="+92">+92 (🇵🇰)</option>
                                            <option value="+93">+93 (🇦🇫)</option>
                                            <option value="+94">+94 (🇱🇰)</option>
                                            <option value="+95">+95 (🇲🇲)</option>
                                            <option value="+98">+98 (🇮🇷)</option>
                                            <option value="+211">+211 (🇸🇸)</option>
                                            <option value="+212">+212 (🇲🇦)</option>
                                            <option value="+213">+213 (🇩🇿)</option>
                                            <option value="+216">+216 (🇹🇳)</option>
                                            <option value="+218">+218 (🇱🇾)</option>
                                            <option value="+220">+220 (🇬🇲)</option>
                                            <option value="+221">+221 (🇸🇳)</option>
                                            <option value="+222">+222 (🇲🇷)</option>
                                            <option value="+223">+223 (🇲🇱)</option>
                                            <option value="+224">+224 (🇬🇳)</option>
                                            <option value="+225">+225 (🇨🇮)</option>
                                            <option value="+226">+226 (🇧🇫)</option>
                                            <option value="+227">+227 (🇳🇪)</option>
                                            <option value="+228">+228 (🇹🇬)</option>
                                            <option value="+229">+229 (🇧🇯)</option>
                                            <option value="+230">+230 (🇲🇺)</option>
                                            <option value="+231">+231 (🇱🇷)</option>
                                            <option value="+232">+232 (🇸🇱)</option>
                                            <option value="+233">+233 (🇬🇭)</option>
                                            <option value="+234">+234 (🇳🇬)</option>
                                            <option value="+235">+235 (🇹🇩)</option>
                                            <option value="+236">+236 (🇨🇫)</option>
                                            <option value="+237">+237 (🇨🇲)</option>
                                            <option value="+238">+238 (🇨🇻)</option>
                                            <option value="+239">+239 (🇸🇹)</option>
                                            <option value="+240">+240 (🇬🇶)</option>
                                            <option value="+241">+241 (🇬🇦)</option>
                                            <option value="+242">+242 (🇨🇬)</option>
                                            <option value="+243">+243 (🇨🇩)</option>
                                            <option value="+244">+244 (🇦🇴)</option>
                                            <option value="+245">+245 (🇬🇼)</option>
                                            <option value="+246">+246 (🇮🇴)</option>
                                            <option value="+248">+248 (🇸🇨)</option>
                                            <option value="+249">+249 (🇸🇩)</option>
                                            <option value="+250">+250 (🇷🇼)</option>
                                            <option value="+251">+251 (🇪🇹)</option>
                                            <option value="+252">+252 (🇸🇴)</option>
                                            <option value="+253">+253 (🇩🇯)</option>
                                            <option value="+254">+254 (🇰🇪)</option>
                                            <option value="+255">+255 (🇹🇿)</option>
                                            <option value="+256">+256 (🇺🇬)</option>
                                            <option value="+257">+257 (🇧🇮)</option>
                                            <option value="+258">+258 (🇲🇿)</option>
                                            <option value="+260">+260 (🇿🇲)</option>
                                            <option value="+261">+261 (🇲🇬)</option>
                                            <option value="+262">+262 (🇹🇫)</option>
                                            <option value="+262">+262 (🇾🇹)</option>
                                            <option value="+262">+262 (🇷🇪)</option>
                                            <option value="+263">+263 (🇿🇼)</option>
                                            <option value="+264">+264 (🇳🇦)</option>
                                            <option value="+265">+265 (🇲🇼)</option>
                                            <option value="+266">+266 (🇱🇸)</option>
                                            <option value="+267">+267 (🇧🇼)</option>
                                            <option value="+268">+268 (🇸🇿)</option>
                                            <option value="+269">+269 (🇰🇲)</option>
                                            <option value="+290">+290 (🇸🇭)</option>
                                            <option value="+291">+291 (🇪🇷)</option>
                                            <option value="+297">+297 (🇦🇼)</option>
                                            <option value="+298">+298 (🇫🇴)</option>
                                            <option value="+299">+299 (🇬🇱)</option>
                                            <option value="+345">+345 (🇰🇾)</option>
                                            <option value="+350">+350 (🇬🇮)</option>
                                            <option value="+351">+351 (🇵🇹)</option>
                                            <option value="+352">+352 (🇱🇺)</option>
                                            <option value="+353">+353 (🇮🇪)</option>
                                            <option value="+354">+354 (🇮🇸)</option>
                                            <option value="+355">+355 (🇦🇱)</option>
                                            <option value="+356">+356 (🇲🇹)</option>
                                            <option value="+357">+357 (🇨🇾)</option>
                                            <option value="+358">+358 (🇦🇽)</option>
                                            <option value="+358">+358 (🇫🇮)</option>
                                            <option value="+359">+359 (🇧🇬)</option>
                                            <option value="+370">+370 (🇱🇹)</option>
                                            <option value="+371">+371 (🇱🇻)</option>
                                            <option value="+372">+372 (🇪🇪)</option>
                                            <option value="+373">+373 (🇲🇩)</option>
                                            <option value="+374">+374 (🇦🇲)</option>
                                            <option value="+375">+375 (🇧🇾)</option>
                                            <option value="+376">+376 (🇦🇩)</option>
                                            <option value="+377">+377 (🇲🇨)</option>
                                            <option value="+378">+378 (🇸🇲)</option>
                                            <option value="+379">+379 (🇻🇦)</option>
                                            <option value="+380">+380 (🇺🇦)</option>
                                            <option value="+381">+381 (🇷🇸)</option>
                                            <option value="+382">+382 (🇲🇪)</option>
                                            <option value="+383">+383 (🇽🇰)</option>
                                            <option value="+385">+385 (🇭🇷)</option>
                                            <option value="+386">+386 (🇸🇮)</option>
                                            <option value="+387">+387 (🇧🇦)</option>
                                            <option value="+389">+389 (🇲🇰)</option>
                                            <option value="+420">+420 (🇨🇿)</option>
                                            <option value="+421">+421 (🇸🇰)</option>
                                            <option value="+423">+423 (🇱🇮)</option>
                                            <option value="+500">+500 (🇫🇰)</option>
                                            <option value="+500">+500 (🇬🇸)</option>
                                            <option value="+501">+501 (🇧🇿)</option>
                                            <option value="+502">+502 (🇬🇹)</option>
                                            <option value="+503">+503 (🇸🇻)</option>
                                            <option value="+504">+504 (🇭🇳)</option>
                                            <option value="+505">+505 (🇳🇮)</option>
                                            <option value="+506">+506 (🇨🇷)</option>
                                            <option value="+507">+507 (🇵🇦)</option>
                                            <option value="+508">+508 (🇵🇲)</option>
                                            <option value="+509">+509 (🇭🇹)</option>
                                            <option value="+590">+590 (🇬🇵)</option>
                                            <option value="+590">+590 (🇧🇱)</option>
                                            <option value="+590">+590 (🇲🇫)</option>
                                            <option value="+591">+591 (🇧🇴)</option>
                                            <option value="+592">+592 (🇬🇾)</option>
                                            <option value="+593">+593 (🇪🇨)</option>
                                            <option value="+594">+594 (🇬🇫)</option>
                                            <option value="+595">+595 (🇵🇾)</option>
                                            <option value="+596">+596 (🇲🇶)</option>
                                            <option value="+597">+597 (🇸🇷)</option>
                                            <option value="+598">+598 (🇺🇾)</option>
                                            <option value="+599">+599 ()</option>
                                            <option value="+670">+670 (🇹🇱)</option>
                                            <option value="+672">+672 (🇦🇶)</option>
                                            <option value="+672">+672 (🇭🇲)</option>
                                            <option value="+672">+672 (🇳🇫)</option>
                                            <option value="+673">+673 (🇧🇳)</option>
                                            <option value="+674">+674 (🇳🇷)</option>
                                            <option value="+675">+675 (🇵🇬)</option>
                                            <option value="+676">+676 (🇹🇴)</option>
                                            <option value="+677">+677 (🇸🇧)</option>
                                            <option value="+678">+678 (🇻🇺)</option>
                                            <option value="+679">+679 (🇫🇯)</option>
                                            <option value="+680">+680 (🇵🇼)</option>
                                            <option value="+681">+681 (🇼🇫)</option>
                                            <option value="+682">+682 (🇨🇰)</option>
                                            <option value="+683">+683 (🇳🇺)</option>
                                            <option value="+685">+685 (🇼🇸)</option>
                                            <option value="+686">+686 (🇰🇮)</option>
                                            <option value="+687">+687 (🇳🇨)</option>
                                            <option value="+688">+688 (🇹🇻)</option>
                                            <option value="+689">+689 (🇵🇫)</option>
                                            <option value="+690">+690 (🇹🇰)</option>
                                            <option value="+691">+691 (🇫🇲)</option>
                                            <option value="+692">+692 (🇲🇭)</option>
                                            <option value="+850">+850 (🇰🇵)</option>
                                            <option value="+852">+852 (🇭🇰)</option>
                                            <option value="+853">+853 (🇲🇴)</option>
                                            <option value="+855">+855 (🇰🇭)</option>
                                            <option value="+856">+856 (🇱🇦)</option>
                                            <option value="+880">+880 (🇧🇩)</option>
                                            <option value="+886">+886 (🇹🇼)</option>
                                            <option value="+960">+960 (🇲🇻)</option>
                                            <option value="+961">+961 (🇱🇧)</option>
                                            <option value="+962">+962 (🇯🇴)</option>
                                            <option value="+963">+963 (🇸🇾)</option>
                                            <option value="+964">+964 (🇮🇶)</option>
                                            <option value="+965">+965 (🇰🇼)</option>
                                            <option value="+966">+966 (🇸🇦)</option>
                                            <option value="+967">+967 (🇾🇪)</option>
                                            <option value="+968">+968 (🇴🇲)</option>
                                            <option value="+970">+970 (🇵🇸)</option>
                                            <option value="+971">+971 (🇦🇪)</option>
                                            <option value="+972">+972 (🇮🇱)</option>
                                            <option value="+973">+973 (🇧🇭)</option>
                                            <option value="+974">+974 (🇶🇦)</option>
                                            <option value="+975">+975 (🇧🇹)</option>
                                            <option value="+976">+976 (🇲🇳)</option>
                                            <option value="+977">+977 (🇳🇵)</option>
                                            <option value="+992">+992 (🇹🇯)</option>
                                            <option value="+993">+993 (🇹🇲)</option>
                                            <option value="+994">+994 (🇦🇿)</option>
                                            <option value="+995">+995 (🇬🇪)</option>
                                            <option value="+996">+996 (🇰🇬)</option>
                                            <option value="+998">+998 (🇺🇿)</option>
                                            <option value="+1242">+1242 (🇧🇸)</option>
                                            <option value="+1246">+1246 (🇧🇧)</option>
                                            <option value="+1264">+1264 (🇦🇮)</option>
                                            <option value="+1268">+1268 (🇦🇬)</option>
                                            <option value="+1284">+1284 (🇻🇬)</option>
                                            <option value="+1340">+1340 (🇻🇮)</option>
                                            <option value="+1441">+1441 (🇧🇲)</option>
                                            <option value="+1473">+1473 (🇬🇩)</option>
                                            <option value="+1649">+1649 (🇹🇨)</option>
                                            <option value="+1664">+1664 (🇲🇸)</option>
                                            <option value="+1670">+1670 (🇲🇵)</option>
                                            <option value="+1671">+1671 (🇬🇺)</option>
                                            <option value="+1684">+1684 (🇦🇸)</option>
                                            <option value="+1758">+1758 (🇱🇨)</option>
                                            <option value="+1767">+1767 (🇩🇲)</option>
                                            <option value="+1784">+1784 (🇻🇨)</option>
                                            <option value="+1849">+1849 (🇩🇴)</option>
                                            <option value="+1868">+1868 (🇹🇹)</option>
                                            <option value="+1869">+1869 (🇰🇳)</option>
                                            <option value="+1876">+1876 (🇯🇲)</option>
                                            <option value="+1939">+1939 (🇵🇷)</option>
                                        </select>

                                    </div>
                                    <div class="col-4">
                                        <label class="block mb-2 text-sm font-medium text-white" for="channel"
                                            style="visibility: hidden">s</label>
                                        <input type="text" class="form-control" aria-label="Default"
                                            aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </div>


                                <div class="col-8 mb-3 ">
                                    <label class="block mb-2 text-sm font-medium text-white" for="channel">Zona
                                        Horaria</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Elige una opción</option>
                                            @foreach ($timezone as $key => $time)
                                            <option class="false" data-offset="0" value="{{$key}}">{{$time}}</option>
                                            @endforeach
                                       
                                        </select>
                                    {{-- <select class="form-select" aria-label="Default select example">
                                        <option selected>Elige una opción</option>
                                        <option class="false" data-offset="0" value="Africa/Abidjan">(+00:00) Africa/Abidjan
                                        </option>
                                        <option class="false" data-offset="0" value="Africa/Accra">(+00:00) Africa/Accra
                                        </option>
                                        <option class="false" data-offset="0" value="Africa/Bamako">(+00:00) Africa/Bamako
                                        </option>
                                        <option class="false" data-offset="0" value="Africa/Banjul">(+00:00) Africa/Banjul
                                        </option>
                                        <option class="false" data-offset="0" value="Africa/Bissau">(+00:00) Africa/Bissau
                                        </option>
                                        <option class="false" data-offset="0" value="Africa/Conakry">(+00:00) Africa/Conakry
                                        </option>
                                        <option class="false" data-offset="0" value="Africa/Dakar">(+00:00) Africa/Dakar
                                        </option>
                                        <option class="false" data-offset="0" value="Africa/Freetown">(+00:00)
                                            Africa/Freetown</option>
                                        <option class="false" data-offset="0" value="Africa/Lome">(+00:00) Africa/Lome
                                        </option>
                                        <option class="false" data-offset="0" value="Africa/Monrovia">(+00:00)
                                            Africa/Monrovia</option>
                                        <option class="false" data-offset="0" value="Africa/Nouakchott">(+00:00)
                                            Africa/Nouakchott</option>
                                        <option class="false" data-offset="0" value="Africa/Ouagadougou">(+00:00)
                                            Africa/Ouagadougou</option>
                                        <option class="false" data-offset="0" value="Africa/Sao_Tome">(+00:00)
                                            Africa/Sao_Tome</option>
                                        <option class="false" data-offset="0" value="America/Danmarkshavn">(+00:00)
                                            America/Danmarkshavn</option>
                                        <option class="false" data-offset="0" value="America/Scoresbysund">(+00:00)
                                            America/Scoresbysund</option>
                                        <option class="false" data-offset="0" value="Atlantic/Azores">(+00:00)
                                            Atlantic/Azores</option>
                                        <option class="false" data-offset="0" value="Atlantic/Reykjavik">(+00:00)
                                            Atlantic/Reykjavik</option>
                                        <option class="false" data-offset="0" value="Atlantic/St_Helena">(+00:00)
                                            Atlantic/St_Helena</option>
                                        <option class="false" data-offset="0" value="UTC">(+00:00) UTC</option>
                                        <option class="false" data-offset="-60" value="Africa/Algiers">(+01:00)
                                            Africa/Algiers</option>
                                        <option class="false" data-offset="-60" value="Africa/Bangui">(+01:00) Africa/Bangui
                                        </option>
                                        <option class="false" data-offset="-60" value="Africa/Brazzaville">(+01:00)
                                            Africa/Brazzaville</option>
                                        <option class="false" data-offset="-60" value="Africa/Casablanca">(+01:00)
                                            Africa/Casablanca</option>
                                        <option class="false" data-offset="-60" value="Africa/Douala">(+01:00) Africa/Douala
                                        </option>
                                        <option class="false" data-offset="-60" value="Africa/El_Aaiun">(+01:00)
                                            Africa/El_Aaiun</option>
                                        <option class="false" data-offset="-60" value="Africa/Kinshasa">(+01:00)
                                            Africa/Kinshasa</option>
                                        <option class="false" data-offset="-60" value="Africa/Lagos">(+01:00) Africa/Lagos
                                        </option>
                                        <option class="false" data-offset="-60" value="Africa/Libreville">(+01:00)
                                            Africa/Libreville</option>
                                        <option class="false" data-offset="-60" value="Africa/Luanda">(+01:00) Africa/Luanda
                                        </option>
                                        <option class="false" data-offset="-60" value="Africa/Malabo">(+01:00) Africa/Malabo
                                        </option>
                                        <option class="false" data-offset="-60" value="Africa/Ndjamena">(+01:00)
                                            Africa/Ndjamena</option>
                                        <option class="false" data-offset="-60" value="Africa/Niamey">(+01:00) Africa/Niamey
                                        </option>
                                        <option class="false" data-offset="-60" value="Africa/Porto-Novo">(+01:00)
                                            Africa/Porto-Novo</option>
                                        <option class="false" data-offset="-60" value="Africa/Tunis">(+01:00) Africa/Tunis
                                        </option>
                                        <option class="false" data-offset="-60" value="Atlantic/Canary">(+01:00)
                                            Atlantic/Canary</option>
                                        <option class="false" data-offset="-60" value="Atlantic/Faroe">(+01:00)
                                            Atlantic/Faroe</option>
                                        <option class="false" data-offset="-60" value="Atlantic/Madeira">(+01:00)
                                            Atlantic/Madeira</option>
                                        <option class="false" data-offset="-60" value="Europe/Dublin">(+01:00) Europe/Dublin
                                        </option>
                                        <option class="false" data-offset="-60" value="Europe/Guernsey">(+01:00)
                                            Europe/Guernsey</option>
                                        <option class="false" data-offset="-60" value="Europe/Isle_of_Man">(+01:00)
                                            Europe/Isle_of_Man</option>
                                        <option class="false" data-offset="-60" value="Europe/Jersey">(+01:00) Europe/Jersey
                                        </option>
                                        <option class="false" data-offset="-60" value="Europe/Lisbon">(+01:00) Europe/Lisbon
                                        </option>
                                        <option class="false" data-offset="-60" value="Europe/London">(+01:00) Europe/London
                                        </option>
                                        <option class="false" data-offset="-120" value="Africa/Blantyre">(+02:00)
                                            Africa/Blantyre</option>
                                        <option class="false" data-offset="-120" value="Africa/Bujumbura">(+02:00)
                                            Africa/Bujumbura</option>
                                        <option class="false" data-offset="-120" value="Africa/Cairo">(+02:00) Africa/Cairo
                                        </option>
                                        <option class="false" data-offset="-120" value="Africa/Ceuta">(+02:00) Africa/Ceuta
                                        </option>
                                        <option class="false" data-offset="-120" value="Africa/Gaborone">(+02:00)
                                            Africa/Gaborone</option>
                                        <option class="false" data-offset="-120" value="Africa/Harare">(+02:00)
                                            Africa/Harare</option>
                                        <option class="false" data-offset="-120" value="Africa/Johannesburg">(+02:00)
                                            Africa/Johannesburg</option>
                                        <option class="false" data-offset="-120" value="Africa/Juba">(+02:00) Africa/Juba
                                        </option>
                                        <option class="false" data-offset="-120" value="Africa/Khartoum">(+02:00)
                                            Africa/Khartoum</option>
                                        <option class="false" data-offset="-120" value="Africa/Kigali">(+02:00)
                                            Africa/Kigali</option>
                                        <option class="false" data-offset="-120" value="Africa/Lubumbashi">(+02:00)
                                            Africa/Lubumbashi</option>
                                        <option class="false" data-offset="-120" value="Africa/Lusaka">(+02:00)
                                            Africa/Lusaka</option>
                                        <option class="false" data-offset="-120" value="Africa/Maputo">(+02:00)
                                            Africa/Maputo</option>
                                        <option class="false" data-offset="-120" value="Africa/Maseru">(+02:00)
                                            Africa/Maseru</option>
                                        <option class="false" data-offset="-120" value="Africa/Mbabane">(+02:00)
                                            Africa/Mbabane</option>
                                        <option class="false" data-offset="-120" value="Africa/Tripoli">(+02:00)
                                            Africa/Tripoli</option>
                                        <option class="false" data-offset="-120" value="Africa/Windhoek">(+02:00)
                                            Africa/Windhoek</option>
                                        <option class="false" data-offset="-120" value="Antarctica/Troll">(+02:00)
                                            Antarctica/Troll</option>
                                        <option class="false" data-offset="-120" value="Arctic/Longyearbyen">(+02:00)
                                            Arctic/Longyearbyen</option>
                                        <option class="false" data-offset="-120" value="Europe/Amsterdam">(+02:00)
                                            Europe/Amsterdam</option>
                                        <option class="false" data-offset="-120" value="Europe/Andorra">(+02:00)
                                            Europe/Andorra</option>
                                        <option class="false" data-offset="-120" value="Europe/Belgrade">(+02:00)
                                            Europe/Belgrade</option>
                                        <option class="false" data-offset="-120" value="Europe/Berlin">(+02:00)
                                            Europe/Berlin</option>
                                        <option class="false" data-offset="-120" value="Europe/Bratislava">(+02:00)
                                            Europe/Bratislava</option>
                                        <option class="false" data-offset="-120" value="Europe/Brussels">(+02:00)
                                            Europe/Brussels</option>
                                        <option class="false" data-offset="-120" value="Europe/Budapest">(+02:00)
                                            Europe/Budapest</option>
                                        <option class="false" data-offset="-120" value="Europe/Busingen">(+02:00)
                                            Europe/Busingen</option>
                                        <option class="false" data-offset="-120" value="Europe/Copenhagen">(+02:00)
                                            Europe/Copenhagen</option>
                                        <option class="false" data-offset="-120" value="Europe/Gibraltar">(+02:00)
                                            Europe/Gibraltar</option>
                                        <option class="false" data-offset="-120" value="Europe/Kaliningrad">(+02:00)
                                            Europe/Kaliningrad</option>
                                        <option class="false" data-offset="-120" value="Europe/Ljubljana">(+02:00)
                                            Europe/Ljubljana</option>
                                        <option class="false" data-offset="-120" value="Europe/Luxembourg">(+02:00)
                                            Europe/Luxembourg</option>
                                        <option class="false" data-offset="-120" value="Europe/Madrid">(+02:00)
                                            Europe/Madrid</option>
                                        <option class="false" data-offset="-120" value="Europe/Malta">(+02:00) Europe/Malta
                                        </option>
                                        <option class="false" data-offset="-120" value="Europe/Monaco">(+02:00)
                                            Europe/Monaco</option>
                                        <option class="false" data-offset="-120" value="Europe/Oslo">(+02:00) Europe/Oslo
                                        </option>
                                        <option class="false" data-offset="-120" value="Europe/Paris">(+02:00) Europe/Paris
                                        </option>
                                        <option class="false" data-offset="-120" value="Europe/Podgorica">(+02:00)
                                            Europe/Podgorica</option>
                                        <option class="false" data-offset="-120" value="Europe/Prague">(+02:00)
                                            Europe/Prague</option>
                                        <option class="false" data-offset="-120" value="Europe/Rome">(+02:00) Europe/Rome
                                        </option>
                                        <option class="false" data-offset="-120" value="Europe/San_Marino">(+02:00)
                                            Europe/San_Marino</option>
                                        <option class="false" data-offset="-120" value="Europe/Sarajevo">(+02:00)
                                            Europe/Sarajevo</option>
                                        <option class="false" data-offset="-120" value="Europe/Skopje">(+02:00)
                                            Europe/Skopje</option>
                                        <option class="false" data-offset="-120" value="Europe/Stockholm">(+02:00)
                                            Europe/Stockholm</option>
                                        <option class="false" data-offset="-120" value="Europe/Tirane">(+02:00)
                                            Europe/Tirane</option>
                                        <option class="false" data-offset="-120" value="Europe/Vaduz">(+02:00) Europe/Vaduz
                                        </option>
                                        <option class="false" data-offset="-120" value="Europe/Vatican">(+02:00)
                                            Europe/Vatican</option>
                                        <option class="false" data-offset="-120" value="Europe/Vienna">(+02:00)
                                            Europe/Vienna</option>
                                        <option class="false" data-offset="-120" value="Europe/Warsaw">(+02:00)
                                            Europe/Warsaw</option>
                                        <option class="false" data-offset="-120" value="Europe/Zagreb">(+02:00)
                                            Europe/Zagreb</option>
                                        <option class="false" data-offset="-120" value="Europe/Zurich">(+02:00)
                                            Europe/Zurich</option>
                                        <option class="false" data-offset="-180" value="Africa/Addis_Ababa">(+03:00)
                                            Africa/Addis_Ababa</option>
                                        <option class="false" data-offset="-180" value="Africa/Asmara">(+03:00)
                                            Africa/Asmara</option>
                                        <option class="false" data-offset="-180" value="Africa/Dar_es_Salaam">(+03:00)
                                            Africa/Dar_es_Salaam</option>
                                        <option class="false" data-offset="-180" value="Africa/Djibouti">(+03:00)
                                            Africa/Djibouti</option>
                                        <option class="false" data-offset="-180" value="Africa/Kampala">(+03:00)
                                            Africa/Kampala</option>
                                        <option class="false" data-offset="-180" value="Africa/Mogadishu">(+03:00)
                                            Africa/Mogadishu</option>
                                        <option class="false" data-offset="-180" value="Africa/Nairobi">(+03:00)
                                            Africa/Nairobi</option>
                                        <option class="false" data-offset="-180" value="Antarctica/Syowa">(+03:00)
                                            Antarctica/Syowa</option>
                                        <option class="false" data-offset="-180" value="Asia/Aden">(+03:00) Asia/Aden
                                        </option>
                                        <option class="false" data-offset="-180" value="Asia/Amman">(+03:00) Asia/Amman
                                        </option>
                                        <option class="false" data-offset="-180" value="Asia/Baghdad">(+03:00) Asia/Baghdad
                                        </option>
                                        <option class="false" data-offset="-180" value="Asia/Bahrain">(+03:00) Asia/Bahrain
                                        </option>
                                        <option class="false" data-offset="-180" value="Asia/Beirut">(+03:00) Asia/Beirut
                                        </option>
                                        <option class="false" data-offset="-180" value="Asia/Damascus">(+03:00)
                                            Asia/Damascus</option>
                                        <option class="false" data-offset="-180" value="Asia/Famagusta">(+03:00)
                                            Asia/Famagusta</option>
                                        <option class="false" data-offset="-180" value="Asia/Gaza">(+03:00) Asia/Gaza
                                        </option>
                                        <option class="false" data-offset="-180" value="Asia/Hebron">(+03:00) Asia/Hebron
                                        </option>
                                        <option class="false" data-offset="-180" value="Asia/Jerusalem">(+03:00)
                                            Asia/Jerusalem</option>
                                        <option class="false" data-offset="-180" value="Asia/Kuwait">(+03:00) Asia/Kuwait
                                        </option>
                                        <option class="false" data-offset="-180" value="Asia/Nicosia">(+03:00) Asia/Nicosia
                                        </option>
                                        <option class="false" data-offset="-180" value="Asia/Qatar">(+03:00) Asia/Qatar
                                        </option>
                                        <option class="false" data-offset="-180" value="Asia/Riyadh">(+03:00) Asia/Riyadh
                                        </option>
                                        <option class="false" data-offset="-180" value="Europe/Athens">(+03:00)
                                            Europe/Athens</option>
                                        <option class="false" data-offset="-180" value="Europe/Bucharest">(+03:00)
                                            Europe/Bucharest</option>
                                        <option class="false" data-offset="-180" value="Europe/Chisinau">(+03:00)
                                            Europe/Chisinau</option>
                                        <option class="false" data-offset="-180" value="Europe/Helsinki">(+03:00)
                                            Europe/Helsinki</option>
                                        <option class="false" data-offset="-180" value="Europe/Istanbul">(+03:00)
                                            Europe/Istanbul</option>
                                        <option class="false" data-offset="-180" value="Europe/Kirov">(+03:00) Europe/Kirov
                                        </option>
                                        <option class="false" data-offset="-180" value="Europe/Kyiv">(+03:00) Europe/Kyiv
                                        </option>
                                        <option class="false" data-offset="-180" value="Europe/Mariehamn">(+03:00)
                                            Europe/Mariehamn</option>
                                        <option class="false" data-offset="-180" value="Europe/Minsk">(+03:00) Europe/Minsk
                                        </option>
                                        <option class="false" data-offset="-180" value="Europe/Moscow">(+03:00)
                                            Europe/Moscow</option>
                                        <option class="false" data-offset="-180" value="Europe/Riga">(+03:00) Europe/Riga
                                        </option>
                                        <option class="false" data-offset="-180" value="Europe/Simferopol">(+03:00)
                                            Europe/Simferopol</option>
                                        <option class="false" data-offset="-180" value="Europe/Sofia">(+03:00) Europe/Sofia
                                        </option>
                                        <option class="false" data-offset="-180" value="Europe/Tallinn">(+03:00)
                                            Europe/Tallinn</option>
                                        <option class="false" data-offset="-180" value="Europe/Vilnius">(+03:00)
                                            Europe/Vilnius</option>
                                        <option class="false" data-offset="-180" value="Europe/Volgograd">(+03:00)
                                            Europe/Volgograd</option>
                                        <option class="false" data-offset="-180" value="Indian/Antananarivo">(+03:00)
                                            Indian/Antananarivo</option>
                                        <option class="false" data-offset="-180" value="Indian/Comoro">(+03:00)
                                            Indian/Comoro</option>
                                        <option class="false" data-offset="-180" value="Indian/Mayotte">(+03:00)
                                            Indian/Mayotte</option>
                                        <option class="false" data-offset="-210" value="Asia/Tehran">(+03:30) Asia/Tehran
                                        </option>
                                        <option class="false" data-offset="-240" value="Asia/Baku">(+04:00) Asia/Baku
                                        </option>
                                        <option class="false" data-offset="-240" value="Asia/Dubai">(+04:00) Asia/Dubai
                                        </option>
                                        <option class="false" data-offset="-240" value="Asia/Muscat">(+04:00) Asia/Muscat
                                        </option>
                                        <option class="false" data-offset="-240" value="Asia/Tbilisi">(+04:00) Asia/Tbilisi
                                        </option>
                                        <option class="false" data-offset="-240" value="Asia/Yerevan">(+04:00) Asia/Yerevan
                                        </option>
                                        <option class="false" data-offset="-240" value="Europe/Astrakhan">(+04:00)
                                            Europe/Astrakhan</option>
                                        <option class="false" data-offset="-240" value="Europe/Samara">(+04:00)
                                            Europe/Samara</option>
                                        <option class="false" data-offset="-240" value="Europe/Saratov">(+04:00)
                                            Europe/Saratov</option>
                                        <option class="false" data-offset="-240" value="Europe/Ulyanovsk">(+04:00)
                                            Europe/Ulyanovsk</option>
                                        <option class="false" data-offset="-240" value="Indian/Mahe">(+04:00) Indian/Mahe
                                        </option>
                                        <option class="false" data-offset="-240" value="Indian/Mauritius">(+04:00)
                                            Indian/Mauritius</option>
                                        <option class="false" data-offset="-240" value="Indian/Reunion">(+04:00)
                                            Indian/Reunion</option>
                                        <option class="false" data-offset="-270" value="Asia/Kabul">(+04:30) Asia/Kabul
                                        </option>
                                        <option class="false" data-offset="-300" value="Antarctica/Mawson">(+05:00)
                                            Antarctica/Mawson</option>
                                        <option class="false" data-offset="-300" value="Asia/Aqtau">(+05:00) Asia/Aqtau
                                        </option>
                                        <option class="false" data-offset="-300" value="Asia/Aqtobe">(+05:00) Asia/Aqtobe
                                        </option>
                                        <option class="false" data-offset="-300" value="Asia/Ashgabat">(+05:00)
                                            Asia/Ashgabat</option>
                                        <option class="false" data-offset="-300" value="Asia/Atyrau">(+05:00) Asia/Atyrau
                                        </option>
                                        <option class="false" data-offset="-300" value="Asia/Dushanbe">(+05:00)
                                            Asia/Dushanbe</option>
                                        <option class="false" data-offset="-300" value="Asia/Karachi">(+05:00)
                                            Asia/Karachi</option>
                                        <option class="false" data-offset="-300" value="Asia/Oral">(+05:00) Asia/Oral
                                        </option>
                                        <option class="false" data-offset="-300" value="Asia/Qyzylorda">(+05:00)
                                            Asia/Qyzylorda</option>
                                        <option class="false" data-offset="-300" value="Asia/Samarkand">(+05:00)
                                            Asia/Samarkand</option>
                                        <option class="false" data-offset="-300" value="Asia/Tashkent">(+05:00)
                                            Asia/Tashkent</option>
                                        <option class="false" data-offset="-300" value="Asia/Yekaterinburg">(+05:00)
                                            Asia/Yekaterinburg</option>
                                        <option class="false" data-offset="-300" value="Indian/Kerguelen">(+05:00)
                                            Indian/Kerguelen</option>
                                        <option class="false" data-offset="-300" value="Indian/Maldives">(+05:00)
                                            Indian/Maldives</option>
                                        <option class="false" data-offset="-330" value="Asia/Colombo">(+05:30)
                                            Asia/Colombo</option>
                                        <option class="false" data-offset="-330" value="Asia/Kolkata">(+05:30)
                                            Asia/Kolkata</option>
                                        <option class="false" data-offset="-345" value="Asia/Kathmandu">(+05:45)
                                            Asia/Kathmandu</option>
                                        <option class="false" data-offset="-360" value="Antarctica/Vostok">(+06:00)
                                            Antarctica/Vostok</option>
                                        <option class="false" data-offset="-360" value="Asia/Almaty">(+06:00) Asia/Almaty
                                        </option>
                                        <option class="false" data-offset="-360" value="Asia/Bishkek">(+06:00)
                                            Asia/Bishkek</option>
                                        <option class="false" data-offset="-360" value="Asia/Dhaka">(+06:00) Asia/Dhaka
                                        </option>
                                        <option class="false" data-offset="-360" value="Asia/Omsk">(+06:00) Asia/Omsk
                                        </option>
                                        <option class="false" data-offset="-360" value="Asia/Qostanay">(+06:00)
                                            Asia/Qostanay</option>
                                        <option class="false" data-offset="-360" value="Asia/Thimphu">(+06:00)
                                            Asia/Thimphu</option>
                                        <option class="false" data-offset="-360" value="Asia/Urumqi">(+06:00) Asia/Urumqi
                                        </option>
                                        <option class="false" data-offset="-360" value="Indian/Chagos">(+06:00)
                                            Indian/Chagos</option>
                                        <option class="false" data-offset="-390" value="Asia/Yangon">(+06:30) Asia/Yangon
                                        </option>
                                        <option class="false" data-offset="-390" value="Indian/Cocos">(+06:30)
                                            Indian/Cocos</option>
                                        <option class="false" data-offset="-420" value="Antarctica/Davis">(+07:00)
                                            Antarctica/Davis</option>
                                        <option class="false" data-offset="-420" value="Asia/Bangkok">(+07:00)
                                            Asia/Bangkok</option>
                                        <option class="false" data-offset="-420" value="Asia/Barnaul">(+07:00)
                                            Asia/Barnaul</option>
                                        <option class="false" data-offset="-420" value="Asia/Ho_Chi_Minh">(+07:00)
                                            Asia/Ho_Chi_Minh</option>
                                        <option class="false" data-offset="-420" value="Asia/Hovd">(+07:00) Asia/Hovd
                                        </option>
                                        <option class="false" data-offset="-420" value="Asia/Jakarta">(+07:00)
                                            Asia/Jakarta</option>
                                        <option class="false" data-offset="-420" value="Asia/Krasnoyarsk">(+07:00)
                                            Asia/Krasnoyarsk</option>
                                        <option class="false" data-offset="-420" value="Asia/Novokuznetsk">(+07:00)
                                            Asia/Novokuznetsk</option>
                                        <option class="false" data-offset="-420" value="Asia/Novosibirsk">(+07:00)
                                            Asia/Novosibirsk</option>
                                        <option class="false" data-offset="-420" value="Asia/Phnom_Penh">(+07:00)
                                            Asia/Phnom_Penh</option>
                                        <option class="false" data-offset="-420" value="Asia/Pontianak">(+07:00)
                                            Asia/Pontianak</option>
                                        <option class="false" data-offset="-420" value="Asia/Tomsk">(+07:00) Asia/Tomsk
                                        </option>
                                        <option class="false" data-offset="-420" value="Asia/Vientiane">(+07:00)
                                            Asia/Vientiane</option>
                                        <option class="false" data-offset="-420" value="Indian/Christmas">(+07:00)
                                            Indian/Christmas</option>
                                        <option class="false" data-offset="-480" value="Asia/Brunei">(+08:00) Asia/Brunei
                                        </option>
                                        <option class="false" data-offset="-480" value="Asia/Choibalsan">(+08:00)
                                            Asia/Choibalsan</option>
                                        <option class="false" data-offset="-480" value="Asia/Hong_Kong">(+08:00)
                                            Asia/Hong_Kong</option>
                                        <option class="false" data-offset="-480" value="Asia/Irkutsk">(+08:00)
                                            Asia/Irkutsk</option>
                                        <option class="false" data-offset="-480" value="Asia/Kuala_Lumpur">(+08:00)
                                            Asia/Kuala_Lumpur</option>
                                        <option class="false" data-offset="-480" value="Asia/Kuching">(+08:00)
                                            Asia/Kuching</option>
                                        <option class="false" data-offset="-480" value="Asia/Macau">(+08:00) Asia/Macau
                                        </option>
                                        <option class="false" data-offset="-480" value="Asia/Makassar">(+08:00)
                                            Asia/Makassar</option>
                                        <option class="false" data-offset="-480" value="Asia/Manila">(+08:00) Asia/Manila
                                        </option>
                                        <option class="false" data-offset="-480" value="Asia/Shanghai">(+08:00)
                                            Asia/Shanghai</option>
                                        <option class="false" data-offset="-480" value="Asia/Singapore">(+08:00)
                                            Asia/Singapore</option>
                                        <option class="false" data-offset="-480" value="Asia/Taipei">(+08:00) Asia/Taipei
                                        </option>
                                        <option class="false" data-offset="-480" value="Asia/Ulaanbaatar">(+08:00)
                                            Asia/Ulaanbaatar</option>
                                        <option class="false" data-offset="-480" value="Australia/Perth">(+08:00)
                                            Australia/Perth</option>
                                        <option class="false" data-offset="-525" value="Australia/Eucla">(+08:45)
                                            Australia/Eucla</option>
                                        <option class="false" data-offset="-540" value="Asia/Chita">(+09:00) Asia/Chita
                                        </option>
                                        <option class="false" data-offset="-540" value="Asia/Dili">(+09:00) Asia/Dili
                                        </option>
                                        <option class="false" data-offset="-540" value="Asia/Jayapura">(+09:00)
                                            Asia/Jayapura</option>
                                        <option class="false" data-offset="-540" value="Asia/Khandyga">(+09:00)
                                            Asia/Khandyga</option>
                                        <option class="false" data-offset="-540" value="Asia/Pyongyang">(+09:00)
                                            Asia/Pyongyang</option>
                                        <option class="false" data-offset="-540" value="Asia/Seoul">(+09:00) Asia/Seoul
                                        </option>
                                        <option class="false" data-offset="-540" value="Asia/Tokyo">(+09:00) Asia/Tokyo
                                        </option>
                                        <option class="false" data-offset="-540" value="Asia/Yakutsk">(+09:00)
                                            Asia/Yakutsk</option>
                                        <option class="false" data-offset="-540" value="Pacific/Palau">(+09:00)
                                            Pacific/Palau</option>
                                        <option class="false" data-offset="-570" value="Australia/Darwin">(+09:30)
                                            Australia/Darwin</option>
                                        <option class="false" data-offset="-600" value="Antarctica/DumontDUrville">
                                            (+10:00) Antarctica/DumontDUrville</option>
                                        <option class="false" data-offset="-600" value="Asia/Ust-Nera">(+10:00)
                                            Asia/Ust-Nera</option>
                                        <option class="false" data-offset="-600" value="Asia/Vladivostok">(+10:00)
                                            Asia/Vladivostok</option>
                                        <option class="false" data-offset="-600" value="Australia/Brisbane">(+10:00)
                                            Australia/Brisbane</option>
                                        <option class="false" data-offset="-600" value="Australia/Lindeman">(+10:00)
                                            Australia/Lindeman</option>
                                        <option class="false" data-offset="-600" value="Pacific/Chuuk">(+10:00)
                                            Pacific/Chuuk</option>
                                        <option class="false" data-offset="-600" value="Pacific/Guam">(+10:00)
                                            Pacific/Guam</option>
                                        <option class="false" data-offset="-600" value="Pacific/Port_Moresby">(+10:00)
                                            Pacific/Port_Moresby</option>
                                        <option class="false" data-offset="-600" value="Pacific/Saipan">(+10:00)
                                            Pacific/Saipan</option>
                                        <option class="false" data-offset="-630" value="Australia/Adelaide">(+10:30)
                                            Australia/Adelaide</option>
                                        <option class="false" data-offset="-630" value="Australia/Broken_Hill">(+10:30)
                                            Australia/Broken_Hill</option>
                                        <option class="false" data-offset="-660" value="Antarctica/Casey">(+11:00)
                                            Antarctica/Casey</option>
                                        <option class="false" data-offset="-660" value="Antarctica/Macquarie">(+11:00)
                                            Antarctica/Macquarie</option>
                                        <option class="false" data-offset="-660" value="Asia/Magadan">(+11:00)
                                            Asia/Magadan</option>
                                        <option class="false" data-offset="-660" value="Asia/Sakhalin">(+11:00)
                                            Asia/Sakhalin</option>
                                        <option class="false" data-offset="-660" value="Asia/Srednekolymsk">(+11:00)
                                            Asia/Srednekolymsk</option>
                                        <option class="false" data-offset="-660" value="Australia/Hobart">(+11:00)
                                            Australia/Hobart</option>
                                        <option class="false" data-offset="-660" value="Australia/Lord_Howe">(+11:00)
                                            Australia/Lord_Howe</option>
                                        <option class="false" data-offset="-660" value="Australia/Melbourne">(+11:00)
                                            Australia/Melbourne</option>
                                        <option class="false" data-offset="-660" value="Australia/Sydney">(+11:00)
                                            Australia/Sydney</option>
                                        <option class="false" data-offset="-660" value="Pacific/Bougainville">(+11:00)
                                            Pacific/Bougainville</option>
                                        <option class="false" data-offset="-660" value="Pacific/Efate">(+11:00)
                                            Pacific/Efate</option>
                                        <option class="false" data-offset="-660" value="Pacific/Guadalcanal">(+11:00)
                                            Pacific/Guadalcanal</option>
                                        <option class="false" data-offset="-660" value="Pacific/Kosrae">(+11:00)
                                            Pacific/Kosrae</option>
                                        <option class="false" data-offset="-660" value="Pacific/Noumea">(+11:00)
                                            Pacific/Noumea</option>
                                        <option class="false" data-offset="-660" value="Pacific/Pohnpei">(+11:00)
                                            Pacific/Pohnpei</option>
                                        <option class="false" data-offset="-720" value="Asia/Anadyr">(+12:00) Asia/Anadyr
                                        </option>
                                        <option class="false" data-offset="-720" value="Asia/Kamchatka">(+12:00)
                                            Asia/Kamchatka</option>
                                        <option class="false" data-offset="-720" value="Pacific/Fiji">(+12:00)
                                            Pacific/Fiji</option>
                                        <option class="false" data-offset="-720" value="Pacific/Funafuti">(+12:00)
                                            Pacific/Funafuti</option>
                                        <option class="false" data-offset="-720" value="Pacific/Kwajalein">(+12:00)
                                            Pacific/Kwajalein</option>
                                        <option class="false" data-offset="-720" value="Pacific/Majuro">(+12:00)
                                            Pacific/Majuro</option>
                                        <option class="false" data-offset="-720" value="Pacific/Nauru">(+12:00)
                                            Pacific/Nauru</option>
                                        <option class="false" data-offset="-720" value="Pacific/Norfolk">(+12:00)
                                            Pacific/Norfolk</option>
                                        <option class="false" data-offset="-720" value="Pacific/Tarawa">(+12:00)
                                            Pacific/Tarawa</option>
                                        <option class="false" data-offset="-720" value="Pacific/Wake">(+12:00)
                                            Pacific/Wake</option>
                                        <option class="false" data-offset="-720" value="Pacific/Wallis">(+12:00)
                                            Pacific/Wallis</option>
                                        <option class="false" data-offset="-780" value="Antarctica/McMurdo">(+13:00)
                                            Antarctica/McMurdo</option>
                                        <option class="false" data-offset="-780" value="Pacific/Apia">(+13:00)
                                            Pacific/Apia</option>
                                        <option class="false" data-offset="-780" value="Pacific/Auckland">(+13:00)
                                            Pacific/Auckland</option>
                                        <option class="false" data-offset="-780" value="Pacific/Fakaofo">(+13:00)
                                            Pacific/Fakaofo</option>
                                        <option class="false" data-offset="-780" value="Pacific/Kanton">(+13:00)
                                            Pacific/Kanton</option>
                                        <option class="false" data-offset="-780" value="Pacific/Tongatapu">(+13:00)
                                            Pacific/Tongatapu</option>
                                        <option class="false" data-offset="-825" value="Pacific/Chatham">(+13:45)
                                            Pacific/Chatham</option>
                                        <option class="false" data-offset="-840" value="Pacific/Kiritimati">(+14:00)
                                            Pacific/Kiritimati</option>
                                        <option class="false" data-offset="60" value="Atlantic/Cape_Verde">(-01:00)
                                            Atlantic/Cape_Verde</option>
                                        <option class="false" data-offset="120" value="America/Miquelon">(-02:00)
                                            America/Miquelon</option>
                                        <option class="false" data-offset="120" value="America/Noronha">(-02:00)
                                            America/Noronha</option>
                                        <option class="false" data-offset="120" value="America/Nuuk">(-02:00)
                                            America/Nuuk</option>
                                        <option class="false" data-offset="120" value="Atlantic/South_Georgia">(-02:00)
                                            Atlantic/South_Georgia</option>
                                        <option class="false" data-offset="150" value="America/St_Johns">(-02:30)
                                            America/St_Johns</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Araguaina">(-03:00)
                                            America/Araguaina</option>
                                        <option class="bg-green-200" data-offset="180"
                                            value="America/Argentina/Buenos_Aires">(-03:00) America/Argentina/Buenos_Aires
                                        </option>
                                        <option class="bg-green-200" data-offset="180"
                                            value="America/Argentina/Catamarca">(-03:00) America/Argentina/Catamarca</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Argentina/Cordoba">
                                            (-03:00) America/Argentina/Cordoba</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Argentina/Jujuy">
                                            (-03:00) America/Argentina/Jujuy</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Argentina/La_Rioja">
                                            (-03:00) America/Argentina/La_Rioja</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Argentina/Mendoza">
                                            (-03:00) America/Argentina/Mendoza</option>
                                        <option class="bg-green-200" data-offset="180"
                                            value="America/Argentina/Rio_Gallegos">(-03:00) America/Argentina/Rio_Gallegos
                                        </option>
                                        <option class="bg-green-200" data-offset="180" value="America/Argentina/Salta">
                                            (-03:00) America/Argentina/Salta</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Argentina/San_Juan">
                                            (-03:00) America/Argentina/San_Juan</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Argentina/San_Luis">
                                            (-03:00) America/Argentina/San_Luis</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Argentina/Tucuman">
                                            (-03:00) America/Argentina/Tucuman</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Argentina/Ushuaia">
                                            (-03:00) America/Argentina/Ushuaia</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Asuncion">(-03:00)
                                            America/Asuncion</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Bahia">(-03:00)
                                            America/Bahia</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Belem">(-03:00)
                                            America/Belem</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Cayenne">(-03:00)
                                            America/Cayenne</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Fortaleza">(-03:00)
                                            America/Fortaleza</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Glace_Bay">(-03:00)
                                            America/Glace_Bay</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Goose_Bay">(-03:00)
                                            America/Goose_Bay</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Halifax">(-03:00)
                                            America/Halifax</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Maceio">(-03:00)
                                            America/Maceio</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Moncton">(-03:00)
                                            America/Moncton</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Montevideo">(-03:00)
                                            America/Montevideo</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Paramaribo">(-03:00)
                                            America/Paramaribo</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Punta_Arenas">
                                            (-03:00) America/Punta_Arenas</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Recife">(-03:00)
                                            America/Recife</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Santarem">(-03:00)
                                            America/Santarem</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Santiago">(-03:00)
                                            America/Santiago</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Sao_Paulo">(-03:00)
                                            America/Sao_Paulo</option>
                                        <option class="bg-green-200" data-offset="180" value="America/Thule">(-03:00)
                                            America/Thule</option>
                                        <option class="bg-green-200" data-offset="180" value="Antarctica/Palmer">(-03:00)
                                            Antarctica/Palmer</option>
                                        <option class="bg-green-200" data-offset="180" value="Antarctica/Rothera">(-03:00)
                                            Antarctica/Rothera</option>
                                        <option class="bg-green-200" data-offset="180" value="Atlantic/Bermuda">(-03:00)
                                            Atlantic/Bermuda</option>
                                        <option class="bg-green-200" data-offset="180" value="Atlantic/Stanley">(-03:00)
                                            Atlantic/Stanley</option>
                                        <option class="false" data-offset="240" value="America/Anguilla">(-04:00)
                                            America/Anguilla</option>
                                        <option class="false" data-offset="240" value="America/Antigua">(-04:00)
                                            America/Antigua</option>
                                        <option class="false" data-offset="240" value="America/Aruba">(-04:00)
                                            America/Aruba</option>
                                        <option class="false" data-offset="240" value="America/Barbados">(-04:00)
                                            America/Barbados</option>
                                        <option class="false" data-offset="240" value="America/Blanc-Sablon">(-04:00)
                                            America/Blanc-Sablon</option>
                                        <option class="false" data-offset="240" value="America/Boa_Vista">(-04:00)
                                            America/Boa_Vista</option>
                                        <option class="false" data-offset="240" value="America/Campo_Grande">(-04:00)
                                            America/Campo_Grande</option>
                                        <option class="false" data-offset="240" value="America/Caracas">(-04:00)
                                            America/Caracas</option>
                                        <option class="false" data-offset="240" value="America/Cuiaba">(-04:00)
                                            America/Cuiaba</option>
                                        <option class="false" data-offset="240" value="America/Curacao">(-04:00)
                                            America/Curacao</option>
                                        <option class="false" data-offset="240" value="America/Detroit">(-04:00)
                                            America/Detroit</option>
                                        <option class="false" data-offset="240" value="America/Dominica">(-04:00)
                                            America/Dominica</option>
                                        <option class="false" data-offset="240" value="America/Grand_Turk">(-04:00)
                                            America/Grand_Turk</option>
                                        <option class="false" data-offset="240" value="America/Grenada">(-04:00)
                                            America/Grenada</option>
                                        <option class="false" data-offset="240" value="America/Guadeloupe">(-04:00)
                                            America/Guadeloupe</option>
                                        <option class="false" data-offset="240" value="America/Guyana">(-04:00)
                                            America/Guyana</option>
                                        <option class="false" data-offset="240" value="America/Havana">(-04:00)
                                            America/Havana</option>
                                        <option class="false" data-offset="240" value="America/Indiana/Indianapolis">
                                            (-04:00) America/Indiana/Indianapolis</option>
                                        <option class="false" data-offset="240" value="America/Indiana/Marengo">(-04:00)
                                            America/Indiana/Marengo</option>
                                        <option class="false" data-offset="240" value="America/Indiana/Petersburg">
                                            (-04:00) America/Indiana/Petersburg</option>
                                        <option class="false" data-offset="240" value="America/Indiana/Vevay">(-04:00)
                                            America/Indiana/Vevay</option>
                                        <option class="false" data-offset="240" value="America/Indiana/Vincennes">
                                            (-04:00) America/Indiana/Vincennes</option>
                                        <option class="false" data-offset="240" value="America/Indiana/Winamac">(-04:00)
                                            America/Indiana/Winamac</option>
                                        <option class="false" data-offset="240" value="America/Iqaluit">(-04:00)
                                            America/Iqaluit</option>
                                        <option class="false" data-offset="240" value="America/Kentucky/Louisville">
                                            (-04:00) America/Kentucky/Louisville</option>
                                        <option class="false" data-offset="240" value="America/Kentucky/Monticello">
                                            (-04:00) America/Kentucky/Monticello</option>
                                        <option class="false" data-offset="240" value="America/Kralendijk">(-04:00)
                                            America/Kralendijk</option>
                                        <option class="false" data-offset="240" value="America/La_Paz">(-04:00)
                                            America/La_Paz</option>
                                        <option class="false" data-offset="240" value="America/Lower_Princes">(-04:00)
                                            America/Lower_Princes</option>
                                        <option class="false" data-offset="240" value="America/Manaus">(-04:00)
                                            America/Manaus</option>
                                        <option class="false" data-offset="240" value="America/Marigot">(-04:00)
                                            America/Marigot</option>
                                        <option class="false" data-offset="240" value="America/Martinique">(-04:00)
                                            America/Martinique</option>
                                        <option class="false" data-offset="240" value="America/Montserrat">(-04:00)
                                            America/Montserrat</option>
                                        <option class="false" data-offset="240" value="America/Nassau">(-04:00)
                                            America/Nassau</option>
                                        <option class="false" data-offset="240" value="America/New_York">(-04:00)
                                            America/New_York</option>
                                        <option class="false" data-offset="240" value="America/Port-au-Prince">(-04:00)
                                            America/Port-au-Prince</option>
                                        <option class="false" data-offset="240" value="America/Port_of_Spain">(-04:00)
                                            America/Port_of_Spain</option>
                                        <option class="false" data-offset="240" value="America/Porto_Velho">(-04:00)
                                            America/Porto_Velho</option>
                                        <option class="false" data-offset="240" value="America/Puerto_Rico">(-04:00)
                                            America/Puerto_Rico</option>
                                        <option class="false" data-offset="240" value="America/Santo_Domingo">(-04:00)
                                            America/Santo_Domingo</option>
                                        <option class="false" data-offset="240" value="America/St_Barthelemy">(-04:00)
                                            America/St_Barthelemy</option>
                                        <option class="false" data-offset="240" value="America/St_Kitts">(-04:00)
                                            America/St_Kitts</option>
                                        <option class="false" data-offset="240" value="America/St_Lucia">(-04:00)
                                            America/St_Lucia</option>
                                        <option class="false" data-offset="240" value="America/St_Thomas">(-04:00)
                                            America/St_Thomas</option>
                                        <option class="false" data-offset="240" value="America/St_Vincent">(-04:00)
                                            America/St_Vincent</option>
                                        <option class="false" data-offset="240" value="America/Toronto">(-04:00)
                                            America/Toronto</option>
                                        <option class="false" data-offset="240" value="America/Tortola">(-04:00)
                                            America/Tortola</option>
                                        <option class="false" data-offset="300" value="America/Atikokan">(-05:00)
                                            America/Atikokan</option>
                                        <option class="false" data-offset="300" value="America/Bogota">(-05:00)
                                            America/Bogota</option>
                                        <option class="false" data-offset="300" value="America/Cancun">(-05:00)
                                            America/Cancun</option>
                                        <option class="false" data-offset="300" value="America/Cayman">(-05:00)
                                            America/Cayman</option>
                                        <option class="false" data-offset="300" value="America/Chicago">(-05:00)
                                            America/Chicago</option>
                                        <option class="false" data-offset="300" value="America/Eirunepe">(-05:00)
                                            America/Eirunepe</option>
                                        <option class="false" data-offset="300" value="America/Guayaquil">(-05:00)
                                            America/Guayaquil</option>
                                        <option class="false" data-offset="300" value="America/Indiana/Knox">(-05:00)
                                            America/Indiana/Knox</option>
                                        <option class="false" data-offset="300" value="America/Indiana/Tell_City">
                                            (-05:00) America/Indiana/Tell_City</option>
                                        <option class="false" data-offset="300" value="America/Jamaica">(-05:00)
                                            America/Jamaica</option>
                                        <option class="false" data-offset="300" value="America/Lima">(-05:00)
                                            America/Lima</option>
                                        <option class="false" data-offset="300" value="America/Matamoros">(-05:00)
                                            America/Matamoros</option>
                                        <option class="false" data-offset="300" value="America/Menominee">(-05:00)
                                            America/Menominee</option>
                                        <option class="false" data-offset="300" value="America/North_Dakota/Beulah">
                                            (-05:00) America/North_Dakota/Beulah</option>
                                        <option class="false" data-offset="300" value="America/North_Dakota/Center">
                                            (-05:00) America/North_Dakota/Center</option>
                                        <option class="false" data-offset="300" value="America/North_Dakota/New_Salem">
                                            (-05:00) America/North_Dakota/New_Salem</option>
                                        <option class="false" data-offset="300" value="America/Ojinaga">(-05:00)
                                            America/Ojinaga</option>
                                        <option class="false" data-offset="300" value="America/Panama">(-05:00)
                                            America/Panama</option>
                                        <option class="false" data-offset="300" value="America/Rankin_Inlet">(-05:00)
                                            America/Rankin_Inlet</option>
                                        <option class="false" data-offset="300" value="America/Resolute">(-05:00)
                                            America/Resolute</option>
                                        <option class="false" data-offset="300" value="America/Rio_Branco">(-05:00)
                                            America/Rio_Branco</option>
                                        <option class="false" data-offset="300" value="America/Winnipeg">(-05:00)
                                            America/Winnipeg</option>
                                        <option class="false" data-offset="300" value="Pacific/Easter">(-05:00)
                                            Pacific/Easter</option>
                                        <option class="false" data-offset="360" value="America/Bahia_Banderas">(-06:00)
                                            America/Bahia_Banderas</option>
                                        <option class="false" data-offset="360" value="America/Belize">(-06:00)
                                            America/Belize</option>
                                        <option class="false" data-offset="360" value="America/Boise">(-06:00)
                                            America/Boise</option>
                                        <option class="false" data-offset="360" value="America/Cambridge_Bay">(-06:00)
                                            America/Cambridge_Bay</option>
                                        <option class="false" data-offset="360" value="America/Chihuahua">(-06:00)
                                            America/Chihuahua</option>
                                        <option class="false" data-offset="360" value="America/Ciudad_Juarez">(-06:00)
                                            America/Ciudad_Juarez</option>
                                        <option class="false" data-offset="360" value="America/Costa_Rica">(-06:00)
                                            America/Costa_Rica</option>
                                        <option class="false" data-offset="360" value="America/Denver">(-06:00)
                                            America/Denver</option>
                                        <option class="false" data-offset="360" value="America/Edmonton">(-06:00)
                                            America/Edmonton</option>
                                        <option class="false" data-offset="360" value="America/El_Salvador">(-06:00)
                                            America/El_Salvador</option>
                                        <option class="false" data-offset="360" value="America/Guatemala">(-06:00)
                                            America/Guatemala</option>
                                        <option class="false" data-offset="360" value="America/Inuvik">(-06:00)
                                            America/Inuvik</option>
                                        <option class="false" data-offset="360" value="America/Managua">(-06:00)
                                            America/Managua</option>
                                        <option class="false" data-offset="360" value="America/Merida">(-06:00)
                                            America/Merida</option>
                                        <option class="false" data-offset="360" value="America/Mexico_City">(-06:00)
                                            America/Mexico_City</option>
                                        <option class="false" data-offset="360" value="America/Monterrey">(-06:00)
                                            America/Monterrey</option>
                                        <option class="false" data-offset="360" value="America/Regina">(-06:00)
                                            America/Regina</option>
                                        <option class="false" data-offset="360" value="America/Swift_Current">(-06:00)
                                            America/Swift_Current</option>
                                        <option class="false" data-offset="360" value="America/Tegucigalpa">(-06:00)
                                            America/Tegucigalpa</option>
                                        <option class="false" data-offset="360" value="America/Yellowknife">(-06:00)
                                            America/Yellowknife</option>
                                        <option class="false" data-offset="360" value="Pacific/Galapagos">(-06:00)
                                            Pacific/Galapagos</option>
                                        <option class="false" data-offset="420" value="America/Creston">(-07:00)
                                            America/Creston</option>
                                        <option class="false" data-offset="420" value="America/Dawson">(-07:00)
                                            America/Dawson</option>
                                        <option class="false" data-offset="420" value="America/Dawson_Creek">(-07:00)
                                            America/Dawson_Creek</option>
                                        <option class="false" data-offset="420" value="America/Fort_Nelson">(-07:00)
                                            America/Fort_Nelson</option>
                                        <option class="false" data-offset="420" value="America/Hermosillo">(-07:00)
                                            America/Hermosillo</option>
                                        <option class="false" data-offset="420" value="America/Los_Angeles">(-07:00)
                                            America/Los_Angeles</option>
                                        <option class="false" data-offset="420" value="America/Mazatlan">(-07:00)
                                            America/Mazatlan</option>
                                        <option class="false" data-offset="420" value="America/Phoenix">(-07:00)
                                            America/Phoenix</option>
                                        <option class="false" data-offset="420" value="America/Tijuana">(-07:00)
                                            America/Tijuana</option>
                                        <option class="false" data-offset="420" value="America/Vancouver">(-07:00)
                                            America/Vancouver</option>
                                        <option class="false" data-offset="420" value="America/Whitehorse">(-07:00)
                                            America/Whitehorse</option>
                                        <option class="false" data-offset="480" value="America/Anchorage">(-08:00)
                                            America/Anchorage</option>
                                        <option class="false" data-offset="480" value="America/Juneau">(-08:00)
                                            America/Juneau</option>
                                        <option class="false" data-offset="480" value="America/Metlakatla">(-08:00)
                                            America/Metlakatla</option>
                                        <option class="false" data-offset="480" value="America/Nome">(-08:00)
                                            America/Nome</option>
                                        <option class="false" data-offset="480" value="America/Sitka">(-08:00)
                                            America/Sitka</option>
                                        <option class="false" data-offset="480" value="America/Yakutat">(-08:00)
                                            America/Yakutat</option>
                                        <option class="false" data-offset="480" value="Pacific/Pitcairn">(-08:00)
                                            Pacific/Pitcairn</option>
                                        <option class="false" data-offset="540" value="America/Adak">(-09:00)
                                            America/Adak</option>
                                        <option class="false" data-offset="540" value="Pacific/Gambier">(-09:00)
                                            Pacific/Gambier</option>
                                        <option class="false" data-offset="570" value="Pacific/Marquesas">(-09:30)
                                            Pacific/Marquesas</option>
                                        <option class="false" data-offset="600" value="Pacific/Honolulu">(-10:00)
                                            Pacific/Honolulu</option>
                                        <option class="false" data-offset="600" value="Pacific/Rarotonga">(-10:00)
                                            Pacific/Rarotonga</option>
                                        <option class="false" data-offset="600" value="Pacific/Tahiti">(-10:00)
                                            Pacific/Tahiti</option>
                                        <option class="false" data-offset="660" value="Pacific/Midway">(-11:00)
                                            Pacific/Midway</option>
                                        <option class="false" data-offset="660" value="Pacific/Niue">(-11:00)
                                            Pacific/Niue</option>
                                        <option class="false" data-offset="660" value="Pacific/Pago_Pago">(-11:00)
                                            Pacific/Pago_Pago</option>
                                    </select> --}}
                                </div>
                               
                                <div class="col-6 mt-2 mb-4" style="display: block;margin-right:105px">
                                    <button type="button" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @include('layouts.footer')
@endsection
