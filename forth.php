<?php

$re = '/<td class="right([^"]*)">([^"]*)<\/td>/m';
$str = '<table>
								<tbody><tr>
							<td class="bold">Vejnavn
							</td><td class="right">Blegkilde Allé</td>
				</tr>
												<tr>
							<td class="bold">Husnummer
							</td><td class="right">41</td>
				</tr>
												<tr>
							<td class="bold">Etage
							</td><td class="right">4</td>
				</tr>
												<tr>
							<td class="bold">Side
							</td><td class="right">TH</td>
				</tr>
												<tr>
							<td class="bold">Postnummer
							</td><td class="right">9000</td>
				</tr>
												<tr>
							<td class="bold">Boligtype
							</td><td class="right">Lejlighed</td>
				</tr>
												<tr>
							<td class="bold">Værelser
							</td><td class="right">2 vær.</td>
				</tr>
												<tr>
							<td class="bold">Boligareal (m2)
							</td><td class="right">83</td>
				</tr>
												<tr>
							<td class="bold">Husleje (Mdl.)
							</td><td class="right digits">6.995</td>
				</tr>
												<tr>
							<td class="bold">A/C forbrug
							</td><td class="right digits">500</td>
				</tr>
												<tr>
							<td class="bold">Depositum
							</td><td class="right digits">20.985</td>
				</tr>
												<tr>
							<td class="bold">Forudbetalt leje
							</td><td class="right digits">6.995</td>
				</tr>
												<tr>
							<td class="bold">Lejeperiode
							</td><td class="right digits">ubegrænset</td>
				</tr>
												<tr class="overdragelsesdato">
							<td class="bold">Overtagelsesdato
							</td><td class="right">Snarest</td>
				</tr>
												<tr>
							<td class="bold">Delevenlig
							</td><td class="right">Nej</td>
				</tr>
												<tr>
							<td class="bold">Husdyr tilladt
							</td><td class="right">Nej</td>
				</tr>
												
    		</tbody></table>';

preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);

// Print the entire match result
var_dump($matches);


?>