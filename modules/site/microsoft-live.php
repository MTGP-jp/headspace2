<?php

/**
 * HeadSpace
 *
 * @package HeadSpace
 * @author John Godley
 **/

/*
============================================================================================================
This software is provided "as is" and any express or implied warranties, including, but not limited to, the
implied warranties of merchantibility and fitness for a particular purpose are disclaimed. In no event shall
the copyright owner or contributors be liable for any direct, indirect, incidental, special, exemplary, or
consequential damages (including, but not limited to, procurement of substitute goods or services; loss of
use, data, or profits; or business interruption) however caused and on any theory of liability, whether in
contract, strict liability, or tort (including negligence or otherwise) arising in any way out of the use of
this software, even if advised of the possibility of such damage.

For full license details see license.txt
============================================================================================================ */

class HSS_MicrosoftLive extends HS_SiteModule
{
	var $code = '';

	function name ()
	{
		return __ ('Microsoft Live Verification / Bing Webmaster', 'headspace');
	}

	function description ()
	{
		return __ ('Adds Microsoft Live verification / Bing Webmaster code to your home page', 'headspace');
	}

	function run ()
	{
		add_filter ('wp_head', array (&$this, 'wp_head'));
	}

	function wp_head ()
	{
		// Only need to put this on the home page
		if ($this->code && is_front_page ())
			echo '<meta name="msvalidate.01" content="'.esc_attr ($this->code).'"/>'."\r\n";
	}

	function load( $data = '' )
	{
		if (isset ($data['code']))
			$this->code = $data['code'];
	}

	function has_config () { return true; }

	function save_options ($data)
	{
		return array ('code' => $data['code']);
	}

	function edit ()
	{
	?>
	<tr>
		<th width="150"><?php _e ('Verification code', 'headspace'); ?>:</th>
		<td>
			<input size="40" name="code" type="text" value="<?php echo esc_attr ($this->code); ?>"/><br/>
			<span class="sub"><?php _e ('Enter Microsoft Live verification code.', 'headspace'); ?></span>
		</td>
	</tr>
	<?php
	}

	function file ()
	{
		return basename (__FILE__);
	}
}
