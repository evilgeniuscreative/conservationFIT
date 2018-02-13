<form accept-charset="UTF-8" id="inat-form-obs-add" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
    <input type="hidden" name="action" value="inat_form_obs_add">
    <div>
        <div class="form-item form-type-textfield form-item-inat-obs-add-species-guess">
            <label for="edit-inat-obs-add-species-guess">What did you see?</label>
            <input type="text" class="form-text" maxlength="128" size="60" value="" name="inat_obs_add_species_guess"
                   id="edit-inat-obs-add-species-guess">
        </div>
        <div class="form-item form-type-textfield form-item-inat-obs-add-taxon-id">
            <label for="edit-inat-obs-add-taxon-id">Taxon</label>
            <input type="text" class="form-text" maxlength="128" size="60" value="" name="inat_obs_add_taxon_id"
                   id="edit-inat-obs-add-taxon-id">
        </div>
        <div class="form-item form-type-radios form-item-inat-obs-add-id-please">
            <label for="edit-inat-obs-add-id-please">Do you need identification help?</label>
            <div class="form-radios" id="edit-inat-obs-add-id-please">
                <div class="form-item form-type-radio form-item-inat-obs-add-id-please">
                    <input type="radio" class="form-radio" value="0" name="inat_obs_add_id_please"
                           id="edit-inat-obs-add-id-please-0"> <label for="edit-inat-obs-add-id-please-0"
                                                                      class="option">No</label>
                </div>
                <div class="form-item form-type-radio form-item-inat-obs-add-id-please">
                    <input type="radio" class="form-radio" value="1" name="inat_obs_add_id_please"
                           id="edit-inat-obs-add-id-please-1"> <label for="edit-inat-obs-add-id-please-1"
                                                                      class="option">Yes</label>
                </div>
            </div>
        </div>
        <div class="form-item form-type-textfield form-item-inat-obs-add-observed-on-string">
            <label for="edit-inat-obs-add-observed-on-string">Date Observed</label>
            <input type="text" class="form-text" maxlength="128" size="60" value="<? echo  date('Y-m-d') ?>"
                   name="inat_obs_add_observed_on_string" id="edit-inat-obs-add-observed-on-string">
            <div class="description">YYYY-MM-DD (ex: 2014-04-28)</div>
        </div>
        <div class="form-item form-type-textfield form-item-inat-obs-add-time-zone">
            <label for="edit-inat-obs-add-time-zone">Time Zone</label>
            <select class="time_zone" name="observation[time_zone]" id="observation_time_zone">
                <option value="Hawaii">(GMT-10:00) Hawaii</option>
                <option value="Alaska">(GMT-09:00) Alaska</option>
                <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                <option value="Arizona">(GMT-07:00) Arizona</option>
                <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                <option value="Central Time (US &amp; Canada)">(GMT-06:00) Central Time (US &amp; Canada)</option>
                <option selected="selected" value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp;
                    Canada)
                </option>
                <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
                <option value="" disabled="disabled">-------------</option>
                <option value="American Samoa">(GMT-11:00) American Samoa</option>
                <option value="International Date Line West">(GMT-11:00) International Date Line West</option>
                <option value="Midway Island">(GMT-11:00) Midway Island</option>
                <option value="Tijuana">(GMT-08:00) Tijuana</option>
                <option value="Chihuahua">(GMT-07:00) Chihuahua</option>
                <option value="Mazatlan">(GMT-07:00) Mazatlan</option>
                <option value="Central America">(GMT-06:00) Central America</option>
                <option value="Guadalajara">(GMT-06:00) Guadalajara</option>
                <option value="Mexico City">(GMT-06:00) Mexico City</option>
                <option value="Monterrey">(GMT-06:00) Monterrey</option>
                <option value="Saskatchewan">(GMT-06:00) Saskatchewan</option>
                <option value="Bogota">(GMT-05:00) Bogota</option>
                <option value="Lima">(GMT-05:00) Lima</option>
                <option value="Quito">(GMT-05:00) Quito</option>
                <option value="Atlantic Time (Canada)">(GMT-04:00) Atlantic Time (Canada)</option>
                <option value="Caracas">(GMT-04:00) Caracas</option>
                <option value="Georgetown">(GMT-04:00) Georgetown</option>
                <option value="La Paz">(GMT-04:00) La Paz</option>
                <option value="Santiago">(GMT-04:00) Santiago</option>
                <option value="Newfoundland">(GMT-03:30) Newfoundland</option>
                <option value="Brasilia">(GMT-03:00) Brasilia</option>
                <option value="Buenos Aires">(GMT-03:00) Buenos Aires</option>
                <option value="Greenland">(GMT-03:00) Greenland</option>
                <option value="Montevideo">(GMT-03:00) Montevideo</option>
                <option value="Mid-Atlantic">(GMT-02:00) Mid-Atlantic</option>
                <option value="Atlantic/Cape_Verde">(GMT-01:00) Atlantic/Cape_Verde</option>
                <option value="Azores">(GMT-01:00) Azores</option>
                <option value="Cape Verde Is.">(GMT-01:00) Cape Verde Is.</option>
                <option value="Casablanca">(GMT+00:00) Casablanca</option>
                <option value="Dublin">(GMT+00:00) Dublin</option>
                <option value="Edinburgh">(GMT+00:00) Edinburgh</option>
                <option value="Europe/London">(GMT+00:00) Europe/London</option>
                <option value="Lisbon">(GMT+00:00) Lisbon</option>
                <option value="London">(GMT+00:00) London</option>
                <option value="Monrovia">(GMT+00:00) Monrovia</option>
                <option value="UTC">(GMT+00:00) UTC</option>
                <option value="Amsterdam">(GMT+01:00) Amsterdam</option>
                <option value="Belgrade">(GMT+01:00) Belgrade</option>
                <option value="Berlin">(GMT+01:00) Berlin</option>
                <option value="Bern">(GMT+01:00) Bern</option>
                <option value="Bratislava">(GMT+01:00) Bratislava</option>
                <option value="Brussels">(GMT+01:00) Brussels</option>
                <option value="Budapest">(GMT+01:00) Budapest</option>
                <option value="Copenhagen">(GMT+01:00) Copenhagen</option>
                <option value="Ljubljana">(GMT+01:00) Ljubljana</option>
                <option value="Madrid">(GMT+01:00) Madrid</option>
                <option value="Paris">(GMT+01:00) Paris</option>
                <option value="Prague">(GMT+01:00) Prague</option>
                <option value="Rome">(GMT+01:00) Rome</option>
                <option value="Sarajevo">(GMT+01:00) Sarajevo</option>
                <option value="Skopje">(GMT+01:00) Skopje</option>
                <option value="Stockholm">(GMT+01:00) Stockholm</option>
                <option value="Vienna">(GMT+01:00) Vienna</option>
                <option value="Warsaw">(GMT+01:00) Warsaw</option>
                <option value="West Central Africa">(GMT+01:00) West Central Africa</option>
                <option value="Zagreb">(GMT+01:00) Zagreb</option>
                <option value="Africa/Johannesburg">(GMT+02:00) Africa/Johannesburg</option>
                <option value="Athens">(GMT+02:00) Athens</option>
                <option value="Bucharest">(GMT+02:00) Bucharest</option>
                <option value="Cairo">(GMT+02:00) Cairo</option>
                <option value="Harare">(GMT+02:00) Harare</option>
                <option value="Helsinki">(GMT+02:00) Helsinki</option>
                <option value="Jerusalem">(GMT+02:00) Jerusalem</option>
                <option value="Kaliningrad">(GMT+02:00) Kaliningrad</option>
                <option value="Kyiv">(GMT+02:00) Kyiv</option>
                <option value="Pretoria">(GMT+02:00) Pretoria</option>
                <option value="Riga">(GMT+02:00) Riga</option>
                <option value="Sofia">(GMT+02:00) Sofia</option>
                <option value="Tallinn">(GMT+02:00) Tallinn</option>
                <option value="Vilnius">(GMT+02:00) Vilnius</option>
                <option value="Baghdad">(GMT+03:00) Baghdad</option>
                <option value="Istanbul">(GMT+03:00) Istanbul</option>
                <option value="Kuwait">(GMT+03:00) Kuwait</option>
                <option value="Minsk">(GMT+03:00) Minsk</option>
                <option value="Moscow">(GMT+03:00) Moscow</option>
                <option value="Nairobi">(GMT+03:00) Nairobi</option>
                <option value="Riyadh">(GMT+03:00) Riyadh</option>
                <option value="St. Petersburg">(GMT+03:00) St. Petersburg</option>
                <option value="Volgograd">(GMT+03:00) Volgograd</option>
                <option value="Tehran">(GMT+03:30) Tehran</option>
                <option value="Abu Dhabi">(GMT+04:00) Abu Dhabi</option>
                <option value="Baku">(GMT+04:00) Baku</option>
                <option value="Muscat">(GMT+04:00) Muscat</option>
                <option value="Samara">(GMT+04:00) Samara</option>
                <option value="Tbilisi">(GMT+04:00) Tbilisi</option>
                <option value="Yerevan">(GMT+04:00) Yerevan</option>
                <option value="Kabul">(GMT+04:30) Kabul</option>
                <option value="Ekaterinburg">(GMT+05:00) Ekaterinburg</option>
                <option value="Islamabad">(GMT+05:00) Islamabad</option>
                <option value="Karachi">(GMT+05:00) Karachi</option>
                <option value="Tashkent">(GMT+05:00) Tashkent</option>
                <option value="Chennai">(GMT+05:30) Chennai</option>
                <option value="Kolkata">(GMT+05:30) Kolkata</option>
                <option value="Mumbai">(GMT+05:30) Mumbai</option>
                <option value="New Delhi">(GMT+05:30) New Delhi</option>
                <option value="Sri Jayawardenepura">(GMT+05:30) Sri Jayawardenepura</option>
                <option value="Kathmandu">(GMT+05:45) Kathmandu</option>
                <option value="Almaty">(GMT+06:00) Almaty</option>
                <option value="Astana">(GMT+06:00) Astana</option>
                <option value="Dhaka">(GMT+06:00) Dhaka</option>
                <option value="Urumqi">(GMT+06:00) Urumqi</option>
                <option value="Rangoon">(GMT+06:30) Rangoon</option>
                <option value="Bangkok">(GMT+07:00) Bangkok</option>
                <option value="Hanoi">(GMT+07:00) Hanoi</option>
                <option value="Jakarta">(GMT+07:00) Jakarta</option>
                <option value="Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                <option value="Novosibirsk">(GMT+07:00) Novosibirsk</option>
                <option value="Australia/Perth">(GMT+08:00) Australia/Perth</option>
                <option value="Beijing">(GMT+08:00) Beijing</option>
                <option value="Chongqing">(GMT+08:00) Chongqing</option>
                <option value="Hong Kong">(GMT+08:00) Hong Kong</option>
                <option value="Irkutsk">(GMT+08:00) Irkutsk</option>
                <option value="Kuala Lumpur">(GMT+08:00) Kuala Lumpur</option>
                <option value="Perth">(GMT+08:00) Perth</option>
                <option value="Singapore">(GMT+08:00) Singapore</option>
                <option value="Taipei">(GMT+08:00) Taipei</option>
                <option value="Ulaanbaatar">(GMT+08:00) Ulaanbaatar</option>
                <option value="Osaka">(GMT+09:00) Osaka</option>
                <option value="Sapporo">(GMT+09:00) Sapporo</option>
                <option value="Seoul">(GMT+09:00) Seoul</option>
                <option value="Tokyo">(GMT+09:00) Tokyo</option>
                <option value="Yakutsk">(GMT+09:00) Yakutsk</option>
                <option value="Adelaide">(GMT+09:30) Adelaide</option>
                <option value="Darwin">(GMT+09:30) Darwin</option>
                <option value="Brisbane">(GMT+10:00) Brisbane</option>
                <option value="Canberra">(GMT+10:00) Canberra</option>
                <option value="Guam">(GMT+10:00) Guam</option>
                <option value="Hobart">(GMT+10:00) Hobart</option>
                <option value="Melbourne">(GMT+10:00) Melbourne</option>
                <option value="Pacific/Port_Moresby">(GMT+10:00) Pacific/Port_Moresby</option>
                <option value="Port Moresby">(GMT+10:00) Port Moresby</option>
                <option value="Sydney">(GMT+10:00) Sydney</option>
                <option value="Vladivostok">(GMT+10:00) Vladivostok</option>
                <option value="Asia/Magadan">(GMT+11:00) Asia/Magadan</option>
                <option value="Magadan">(GMT+11:00) Magadan</option>
                <option value="New Caledonia">(GMT+11:00) New Caledonia</option>
                <option value="Solomon Is.">(GMT+11:00) Solomon Is.</option>
                <option value="Srednekolymsk">(GMT+11:00) Srednekolymsk</option>
                <option value="Auckland">(GMT+12:00) Auckland</option>
                <option value="Fiji">(GMT+12:00) Fiji</option>
                <option value="Kamchatka">(GMT+12:00) Kamchatka</option>
                <option value="Marshall Is.">(GMT+12:00) Marshall Is.</option>
                <option value="Pacific/Majuro">(GMT+12:00) Pacific/Majuro</option>
                <option value="Wellington">(GMT+12:00) Wellington</option>
                <option value="Chatham Is.">(GMT+12:45) Chatham Is.</option>
                <option value="Nuku'alofa">(GMT+13:00) Nuku'alofa</option>
                <option value="Samoa">(GMT+13:00) Samoa</option>
                <option value="Tokelau Is.">(GMT+13:00) Tokelau Is.</option>
            </select>
        </div>
        <div class="form-item form-type-textarea form-item-inat-obs-add-description">
            <label for="edit-inat-obs-add-description">Description</label>
            <div class="form-textarea-wrapper resizable textarea-processed resizable-textarea">
                <textarea class="form-textarea" rows="5" cols="60" name="inat_obs_add_description"
                          id="edit-inat-obs-add-description"></textarea>
            </div>
        </div>
        <div class="form-item form-type-textfield form-item-inat-obs-add-place-guess">
            <label for="edit-inat-obs-add-place-guess">Place</label>
            <input type="text" class="form-text" maxlength="128" size="60" value="" name="inat_obs_add_place_guess"
                   id="edit-inat-obs-add-place-guess">
        </div>
        <div class="form-item form-type-textfield form-item-inat-obs-add-latitude">
            <label for="edit-inat-obs-add-latitude">Latitude </label>
            <input type="text" class="form-text" maxlength="128" size="60" value="" name="inat_obs_add_latitude"
                   id="edit-inat-obs-add-latitude">
            <div class="description">Latitude of the observation. (Format: WGS84)</div>
        </div>
        <div class="form-item form-type-textfield form-item-inat-obs-add-longitude">
            <label for="edit-inat-obs-add-longitude">Longitude </label>
            <input type="text" class="form-text" maxlength="128" size="60" value="" name="inat_obs_add_longitude"
                   id="edit-inat-obs-add-longitude">
            <div class="description">Longitide of the observation. (Format: WGS84)</div>
        </div>
        <!--        <input type="hidden" value="form-wgvLgl_girxRCnRkMKXJ6FAoQrNvYibo5lvowsTUbJo" name="form_build_id">-->
        <!--        <input type="hidden" value="__3eDu39QL78w2-XZHT9yxiGC5t3_zN2j5-BZAlLctg" name="form_token">-->
        <input type="hidden" value="inat_obs_obs_add" name="form_id">
        <div id="edit-actions" class="form-actions form-wrapper">
            <input type="submit" class="form-submit" value="Add observation" name="op"
                   id="edit-submit">
        </div>
    </div>
    <input type="hidden" name="inat_base_url" value="<?php echo get_option('inat_base_url') ?>"/>
    <input type="hidden" name="inat_login_id" value="<?php echo get_option('inat_login_id') ?>"/>
    <input type="hidden" name="site_url" value="<?php echo site_url() ?>"/>
    <input type="hidden" name="inat_login_callback" value="<?php echo get_option('inat_login_callback') ?>"/>
    <input type="hidden" name="inat_post_id" value="<?php echo get_option('inat_post_id') ?>"/>
</form>