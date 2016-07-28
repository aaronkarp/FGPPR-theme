          <div class="clearfix"></div>
        </div><!-- end .content -->
      </div><!-- end .mainBody -->
      <div class="footer">
        <ul class="locations">
          <li><div class="unknown-device"><a href="http://maps.google.com/maps?q=222+North+LaSalle+Street+Suite+1400+Chicago,+IL+60601&hl=en&sll=33.767713,-84.420604&sspn=0.512011,1.056747&hnear=222+N+LaSalle+St+%231400,+Chicago,+Illinois+60601&t=m&z=17">Chicago, IL</a></div><div class="mobile-only"><a href="maps:daddr=222%20North%20LaSalle%20Street%20Suite%201400%20Chicago,%20IL%2060601">Chicago, IL</a></div><div class="android-only"><a href="geo:0,0?q=222+North+LaSalle+Street+Suite+1400+Chicago,+IL+60601">Chicago, IL</a></div></li>
          <li><div class="unknown-device"><a href="http://maps.google.com/maps?q=450+Newport+Center+Drive+Suite+630+Newport+Beach+CA+92660&hl=en&sll=40.708475,-74.010846&sspn=0.007295,0.016512&hnear=450+Newport+Center+Dr+%23630,+Newport+Beach,+Orange,+California+92660&t=m&z=17">Newport Beach, CA</a></div><div class="mobile-only"><a href="maps:daddr=450%20Newport%20Center%20Drive%20Suite%20630%20Newport%20Beach%20CA%2092660">Newport Beach, CA</a></div><div class="android-only"><a href="geo:0,0?q=450+Newport+Center+Drive+Suite+630+Newport+Beach+CA+92660">Newport Beach, CA</a></div></li>
          <li><div class="unknown-device"><a href="http://maps.google.com/maps?q=2000+Powell+Street,+Suite+900,+Emeryville,+CA+94608&hl=en&sll=41.886471,-87.633216&sspn=0.007165,0.016512&hnear=2000+Powell+St+%23900,+Emeryville,+Alameda,+California+94608&t=m&z=17">San Francisco, CA</a></div><div class="mobile-only"><a href="maps:daddr=2000%20Powell%20Street%20Suite%20900%20Emeryville%20CA%2094608">San Francisco, CA</a></div><div class="android-only"><a href="geo:0,0?q=2000+Powell+Street+Suite+900+Emeryville+CA+94608">San Francisco, CA</a></div></li>
          <li><div class="unknown-device"><a href="http://maps.google.com/maps?q=120+Broadway,+Suite+1130,+New+York,+NY+10271&hl=en&sll=33.614941,-117.871778&sspn=0.008014,0.016512&hnear=120+Broadway+%231130,+New+York,+10271&t=m&z=17">New York, NY</a></div><div class="mobile-only"><a href="maps:daddr=120%20Broadway%20Suite%201130%20New%20York%20NY%2010271">New York, NY</a></div><div class="android-only"><a href="geo:0,0?q=120+Broadway+Suite+1130+New+York+NY+10271">New York, NY</a></div></li>
        </ul><!-- end .locations -->
        <div class="footerNav">
          <?php wp_nav_menu(array('menu' => 'Footer Menu', 'container' => false)); ?>
          <div class="copyright">&copy;2013 Foran Glennon Palandech Ponzi &amp; Rudloff</div>
        </div><!-- end .footerNav -->
      </div><!-- end .footer -->
    </div><!-- end .container -->
    <script type="text/javascript">
        (function($) {
          var customizeForDevice = function() {
            var ua = navigator.userAgent;
            var checker = {
              mobile: ua.match(/(iPhone|iPod|iPad|IEMobile)/),
              blackberry: ua.match(/BlackBerry/),
              android: ua.match(/Android/),
            };
            if (checker.android){
              $('.android-only').show();
              $('.unknown-device').hide();
            }
            else if (checker.mobile){
              $('.mobile-only').show();
              $('.unknown-device').hide();
            }
          };
          customizeForDevice();
        })(jQuery);
    </script>