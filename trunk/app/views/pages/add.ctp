<!------------- DISPLAY SECTION ------------>
	    	 	<div class="sec_wrapper">
                	<!-- Add Events -->
                	<div id="generic_area">
                    <img src="pub_img/w_add_header.png" width="381" height="49" alt="Feedback" />
                        <div class="generic_box">
                          <h2>Can't find the event? Tell others about it!</h2> 
                        Please fill out the form and information about this cool event you know as much as possible.
                                 <br/>
                                 <br/>
                                <form action="" method="post" name="add_Events">
                                <fieldset><legend> <b>Your information </b></legend>
                                    Name: <input name="name" type="text" size="25" maxlength="100" /><br/>
                                    E-mail: <input name="email" type="text" size="25" maxlength="100" />
                                </fieldset>
                                <fieldset><legend><b>The event details </b></legend>
                                Event's title: <input name="title" type="text" size="25" maxlength="100" /><br/>
                                Location: <input name="location" type="text" size="25" maxlength="100" /><br/>
                                Date: <select name="month"> 
                                <option value="Jan">Jan</option>
                                <option value="Feb">Feb</option>
                                <option value="Mar">Mar</option>
                                <option value="Apr">Apr</option>
                                <option value="May">May</option>
                                <option value="Jun">June</option>
                                <option value="Jul">July</option>
                                <option value="Aug">Aug</option>
                                <option value="Sep">Sep</option>
                                <option value="Oct">Oct</option>
                                <option value="Nov">Nov</option>
                                <option value="Dec">Dec</option>
                                </select>
                                <select name="day">
                                  <option value="1">1</option><option value="2">2</option><option value="3">3</option>
                                  <option value="4">4</option><option value="5">5</option><option value="6">6</option>
                                  <option value="7">7</option><option value="8">8</option><option value="9">9</option>
                                  <option value="10">10</option><option value="11">11</option><option value="12">12</option>
                                  <option value="13">13</option><option value="14">14</option><option value="15">15</option>
                                  <option value="16">16</option><option value="17">17</option><option value="18">18</option>
                                  <option value="19">19</option><option value="20">20</option><option value="21">21</option>
                                  <option value="22">22</option><option value="23">23</option><option value="24">24</option>
                                  <option value="25">25</option><option value="26">26</option><option value="27">27</option>
                                  <option value="28">28</option><option value="29">29</option><option value="30">30</option>
                                  <option value="31">31</option>
                                </select>
                                <input name="year" type="text" size="4" maxlength="4" /> (mm-dd-yyyy)
                                <br/>
                                Time: Hour : <select name="hour">
                                <option value="1">1</option><option value="2">2</option><option value="3">3</option>
                                <option value="4">4</option><option value="5">5</option><option value="6">6</option>
                                <option value="7">7</option><option value="8">8</option><option value="9">9</option>
                                <option value="10">10</option><option value="11">11</option><option value="12">12</option>
                                </select> Min : <select name="min">
                                <option value="0">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                                <option value="50">50</option>
                                </select>
                                <select name="time">
                                <option value="am">am</option>
                                <option value="pm">pm</option>
                                </select><br/>
                                Fee: <select name="fee">
                                	<option value="free">No, it's free. </option>
                                    <option value="pay">Yes </option>
                                </select>
                                if select "<strong>yes</strong>", please specifiy fee in dollars amount: 
                                <input name="fee" type="text" size="3" maxlength="5" /><br/>
                                Age restriction: <select name="age">
                                	<option value="all">For everyone </option>
                                    <option value="kids">Kids Only </option>
                                    <option value="18">18+ Only </option>
                                    <option value="21">21+ Only </option>
                                </select>
                                Type of event: <select name="event_type">
                                <option value="party">party</option>
                                <option value="volunteer">volunteer</option>
                                <option value="info">Info session </option>
                                <option value="job">Career Fairs</option>
                                <option value="sport">Sport event</option>
                                <option value="concert">Concert</option>
                                <option value="drama">Theatre/Play</option>
                                <option value="Marathon">Marathon</option>
                                <option value="Bar Crawl">Bar Crawl</option>
                                
                                
                                
                                </select>
                                
                                </fieldset>
                                <fieldset><legend> <b> Description of the events (What, When, Where, Who, Maps, and etc..)</b></legend>
                                <textarea name="comment" cols="75" rows="15"></textarea>
                                
                                </fieldset>
                                <input name="submit" type="submit" value="Add event" />
                                <input name="" type="reset" />
                                </form>
                          </div>
                  </div>
                  <table width="55px" border="0" cellspacing="5" cellpadding="0">
                      <tr>
                        <td><img src="pub_img/w_add_events.png" alt="Tell Others about event" /></td>
                      </tr>
                    </table>

                </div>	
                <!--- END OF DISPLAY SECTION ------>