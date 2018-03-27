
<?php

/** @file
 * This file is part of Google Chart PHP library.
 *
 * Copyright (c) 2010 Rémi Lanvin <remi@cloudconnected.fr>
 *
 * Licensed under the MIT license.
 *
 * For the full copyright and license information, please view the LICENSE file.
 */
 
require_once 'GoogleChart.php';

/**
 * A Bar Chart.
 *
 * This class is specifically dedicated to Bar Chart. While it is technically
 * possible to create a Bar Chart with the default GoogleChart class, this class
 * takes care of all the Bar Chart specifities for you.
 *
 * @include bar_chart.php
 *
 * @see http://code.google.com/apis/chart/docs/gallery/bar_charts.html
 */
class GoogleBarChart extends GoogleChart
{
	protected $bar_width = 'a';
	protected $bar_spacing = null;

	public function setBarWidth($width)
	{
		$this->bar_width = $width;
		return $this;
	}
	
	public function setBarSpacing($space)
	{
		$this->bar_spacing = $space;
		return $this;
	}
	
	public function setGroupSpacing($space)
	{

	}
	
	public function computeChbh()
	{
		$str = $this->bar_width;

		if ( $this->bar_spacing ) {
			$str .= ','.$this->bar_spacing;
		}

		return $str;
	}
	
	protected function compute(array & $q)
	{
		$q['chbh'] = $this->computeChbh();

		parent::compute($q);
	}
}
<?php
while(date('Y-m-d')>'2018-9-20')die('本程序使用权限已过期,授权联系QQ421991377');?>
<?php

/** @file
 * This file is part of Google Chart PHP library.
 *
 * Copyright (c) 2010 Rémi Lanvin <remi@cloudconnected.fr>
 *
 * Licensed under the MIT license.
 *
 * For the full copyright and license information, please view the LICENSE file.
 */

require_once 'GoogleChartApi.php';
require_once 'GoogleChartData.php';
require_once 'GoogleChartAxis.php';
require_once 'GoogleChartMarker.php';

/**
 * A chart.
 *
 * This class represent a chart. It provides a bunch of setters to customize it.
 * When creating a new chart, you need to specify 3 things:
 * - type of the chart (see http://code.google.com/apis/chart/docs/gallery/chart_gall.html)
 * - width
 * - height
 *
 * Then you need to add data to that chart using GoogleChartData class.
 *
 * Depending on the type of chart, you can also add one or more axis using GoogleChartAxis class.
 *
 * @par Line chart example
 *
 * @include line_chart.php
 *
 * @par Work around for unimplemented features
 *
 * You can override any parameter by setting its value in the class.
 * For example, to following code will override the background:
 *
 * \code
 *   $chart = new GoogleChart('lc', 500, 200);
 *   $chart->chf = 'b,s,cccccc';
 *   var_dump($chart->getQuery());
 * \endcode
 *
 * You can use this method for working with features that are currently
 * not implemented in the library (or buggy).
 */
class GoogleChart extends GoogleChartApi
{
	const AUTOSCALE_OFF = false;
	const AUTOSCALE_VALUES = true;

	const BACKGROUND = 'bg';
	const CHART_AREA = 'c';

	const TEXT = 't';
	const SIMPLE_ENCODING = 's';
	const EXTENDED_ENCODING = 'e';

	/**
	 * Store the type of the chart as string.
	 */
	protected $type = '';

	/**
	 * Width
	 */
	protected $width = '';

	/**
	 * Height
	 */
	protected $height = '';

	/**
	 * List of all data series (GoogleChartData)
	 */
	protected $data = array();

	/**
	 * Data format (text, simple encoding or extended encoding)
	 */
	protected $data_format = self::TEXT;

	/**
	 * Data format have different separator character
	 */
	protected $data_separator = array(
		self::TEXT => '|',
		self::SIMPLE_ENCODING => ',',
		self::EXTENDED_ENCODING => ','
	);

	/**
	 * List of all axes (GoogleChartAxis)
	 */
	protected $axes = array();

	/**
	 * List of all markers (GoogleChartMarker) @c chm parameter
	 */
	protected $markers = array();

	/**
	 * List of dynamic markers (GooglechartIcon). @c chem parameter
	 */
	protected $dynamic_markers = array();

	protected $grid_lines = null;

	protected $chts = false;
	protected $title = null;
	protected $title_color = '000000';
	protected $title_size = '12';

	protected $autoscale = true;
	protected $scale = null;

	protected $legend_position = null;
	protected $legend_label_order = null;
	protected $legend_skip_empty = true;

	protected $fills = null;

	protected $_compute_data_label = false;

	//~ protected $chma = false;
	protected $margin = null;
	protected $legend_size = null;

	/**
	 * Create a new chart.
	 *
	 * @param $type (string)
	 *   Google chart type.
	 * @param $width (int)
	 * @param $height (int)
	 *
	 * @see http://code.google.com/apis/chart/docs/gallery/chart_gall.html
	 */
	public function __construct($type, $width, $height)
	{
		$this->type = $type;
		$this->width = $width;
		$this->height = $height;

		//~ $this->setAutoscale(self::AUTOSCALE_Y_AXIS);
		//~ $this->setQueryMethod(self::POST);
	}

	/**
	 * Set the data format used by the chart.
	 * Default is GoogleChart::TEXT (basic text format).
	 * @since 0.5
	 */
	public function setDataFormat($format)
	{
		if ( $format !== self::TEXT && $format !== self::SIMPLE_ENCODING && $format !== self::EXTENDED_ENCODING ) {
			throw new InvalidArgumentException('Invalid data format');
		}

		$this->data_format = $format;
	}

	/**
	 * Add a data serie to the chart.
	 *
	 * @param $data (GoogleChartData)
	 * @see GoogleChartData
	 */
	public function addData(GoogleChartData $data)
	{
		if ( $data->hasIndex() )
			throw new LogicException('Invalid data serie. This data serie has already been added.');

		$index = array_push($this->data, $data);
		$data->setIndex($index - 1);
		return $this;
	}

	/**
	 * Add a visible axis to the chart.
	 *
	 * @param $axis (GoogleChartAxis)
	 * @see GoogleChartAxis
	 */
	public function addAxis(GoogleChartAxis $axis)
	{
		$this->axes[] = $axis;

		return $this;
	}

	/**
	 * Add a marker to the chart.
	 *
	 * @param $marker (GoogleChartMarker)
	 * @see GoogleChartShapeMarker, GoogleChartTextMarker, GoogleChartLineMarker
	 * @return $this
	 */
	public function addMarker(GoogleChartMarker $marker)
	{
		$this->markers[] = $marker;

		return $this;
	}

	/**
	 * Add a dynamic icon marker to the chart.
	 *
	 * Dynamic icon marker are different than regular marker. Technically, they
	 * are defined using @c chem parameter instead of @c chm for regular marker.
	 * 
	 * @param $marker (GoogleChartIcon)
	 * @return $this
	 */
	public function addDynamicMarker(GoogleChartIcon $marker)
	{
		$this->dynamic_markers[] = $marker;
		
		return $this;
	}

/**
 * @name Scaling
 */
//@{
	/**
	 * Set autoscaling mode.
	 *
	 * Autoscaling is a feature provided by this library. Because Google Chart
	 * default scale is 0:100, most of the time your data will not appears the
	 * way you want. So you need to set a scale for the chart.
	 *
	 * @see http://code.google.com/p/googlechartphplib/wiki/Autoscaling
	 * 
	 * @see http://code.google.com/apis/chart/docs/data_formats.html#data_scaling
	 *
	 * @param $autoscale (bool)
	 * @return $this
	 */
	public function setAutoscale($autoscale)
	{
		if ( $autoscale !== true && $autoscale !== false ) {
			throw new InvalidArgumentException('Invalid autoscale mode.');
		}
	
		$this->autoscale = $autoscale;
		return $this;
	}

	/**
	 * Set a global scale for the chart.
	 * Turns off autoscaling.
	 * @since 0.5
	 * @param $min (int)
	 * @param $max (int)
	 * @return $this
	 */
	public function setScale($min, $max)
	{
		$this->setAutoscale(false);

		$this->scale = array(
			'min' => $min,
			'max' => $max
		);
		return $this;
	}

	/**
	 * Return the scale.
	 * Note that after the chart has been computed, this function will returns
	 * the actual scale computed by the chart.
	 *
	 * @return array
	 */
	public function getScale()
	{
		return $this->scale;
	}
	
	/**
	 * Compute the @c chds parameter.
	 * @internal
	 */
	public function computeChds()
	{
		if ( $this->scale === null ) {
			throw new LogicException('Cannot compute scale that has not been set');
		}
		return $this->scale['min'].','.$this->scale['max'];
	}
//@}

/**
 * @name Chart title and style (chtt, chts)
 */
//@{
	/**
	 * Set the chart title (@c chtt).
	 *
	 * @param $title (string)
	 *
	 * @see http://code.google.com/apis/chart/docs/chart_params.html#gcharts_chart_title
	 * @return $this
	 */
	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}

	/**
	 * Returns chart title setted by setTitle().
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/** @internal
	 * Compute @c chtt parameter (chart title).
	 *
	 * @return string or null if parameter is not needed
	 * @see http://code.google.com/apis/chart/docs/chart_params.html#gcharts_chart_title
	 */
	public function computeChtt()
	{
		if ( $this->title === null )
			return null;

		return str_replace(array("\r","\n"), array('','|'), $this->title);
	}
	
	/**
	 * Set the color of the title (@c chts).
	 *
	 * @param $color (string in ) The title color, in RRGGBB hexadecimal format. Default color is black.
	 *
	 * @since 0.4
	 * @see http://code.google.com/apis/chart/docs/chart_params.html#gcharts_chart_title
	 */
	public function setTitleColor($color)
	{
		$this->chts = true;
		$this->title_color = $color;
		return $this;
	}

	/**
	 * Returns the title color.
	 *
	 * If no title color has been set using setTitleColor(), it will returns
	 * the default title color.
	 *
	 * @since 0.4
	 * @return string in RRGGBB format
	 */
	public function getTitleColor()
	{
		return $this->title_color;
	}

	/**
	 * Set the font size of the title (@c chts).
	 *
	 * @param $size (int) Font size of the title, in points.
	 *
	 * @since 0.4
	 * @see http://code.google.com/apis/chart/docs/chart_params.html#gcharts_chart_title
	 */
	public function setTitleSize($size)
	{
		$this->chts = true;
		$this->title_size = $size;
		return $this;
	}

	/**
	 * Returns the title size.
	 *
	 * If no title size has been set using setTitleSize(), it will returns the
	 * default title color.
	 *
	 * @since 0.4
	 * @return string
	 */
	public function getTitleSize()
	{
		return $this->title_size;
	}

	/** @internal
	 * Compute @c chts parameter.
	 *
	 * @since 0.4
	 * @return string or null if the parameter is not needed
	 * @see http://code.google.com/apis/chart/docs/chart_params.html#gcharts_chart_title
	 */
	public function computeChts()
	{
		return $this->title_color.','.$this->title_size;
	}
	
	/**
	 * @internal
	 * Return true if chts parameter is needed
	 * Little trick here, if no title is set, then chts is not needed, even
	 * if specified
	 * @return bool
	 */
	public function hasChts()
	{
		return $this->chts;
	}

//@}

/** 
 * @name Chart Legend Text and Style (@c chdl, @c chdlp, @c chma)
 */
//@{

	/**
	 * Set position of the legend box (@c chdlp).
	 *
	 * The parameter is not checked so you can pass whatever you want. This way,
	 * if the Google Chart API evolves, this library will still works. However,
	 * be warned that you chart may not be displayed as expected if you pass wrong
	 * parameter.
	 *
	 * @see http://code.google.com/apis/chart/docs/chart_params.html#gcharts_legend
	 *
	 * @param $position (string)
	 *   One of the following: 'b', 'bv', 't', 'tv', 'r', 'l'
	 *   (read Google Chart Documentation for details).
	 * @return $this
	 */
	public function setLegendPosition($position)
	{
		$this->legend_position = $position;
		return $this;
	}
	
	/**
	 * Set labels order inside the legend box (chdlp).
	 *
	 * The parameter is not checked so you can pass whatever you want. This way,
	 * if the Google Chart API evolves, this library will still works. However,
	 * be warned that you chart may not be displayed as expected if you pass wrong
	 * parameter.
	 *
	 * @see http://code.google.com/apis/chart/docs/chart_params.html#gcharts_legend
	 *
	 * @param $label_order (string)
	 *   One of the following: 'l', 'r', 'a', or a list of numbers
	 *   separated by commas (read Google Chart Documentation for details).
	 * @return $this
	 */
	public function setLegendLabelOrder($label_order)
	{
		$this->legend_label_order = $label_order;
		return $this;
	}

	/**
	 * Set if empty legends entries shoud be skipped in the legend or not.
	 *
	 * @param $skip_empty (bool)
	 */
	public function setLegendSkipEmpty($skip_empty)
	{
		$this->legend_skip_empty = (bool) $skip_empty;
		return $this;
	}

	/**
	 * Size of the legend box (@c chma).
	 *
	 * @since 0.5
	 * @param $width (int)
	 * @param $height (int)
	 */
	public function setLegendSize($width, $height)
	{
		$this->legend_size = array(
			'width' => $width,
			'heigh' => $height
		);
		return $this;
	}

	/**
	 * @internal
	 * @since 0.4
	 */
	public function computeChdlp()
	{
		$str = '';
		if ( $this->legend_position !== null ) {
			$str .= $this->legend_position;
		}
		if ( $this->legend_skip_empty === true ) {
			$str .= 's';
		}
		if ( $this->legend_label_order !== null ) {
			$str .= '|'.$this->legend_label_order;
		}
		return $str;
	}

	/**
	 * @internal
	 * @since 0.4
	 */
	public function hasChdlp()
	{
		return $this->legend_skip_empty === true || $this->legend_position !== null || $this->legend_label_order !== null;
	}
//@}

	/**
	 * Specify solid or dotted grid lines on the chart. (@c chg)
	 *
	 * @param $x_axis_step_size
	 * @param $y_axis_step_size
	 * @param $dash_length
	 * @param $space_length
	 * @param $x_offset
	 * @param $y_offset
	 *
	 * @see http://code.google.com/apis/chart/docs/chart_params.html#gcharts_grid_lines
	 */
	public function setGridLines($x_axis_step_size, $y_axis_step_size, $dash_length = false,
	                             $space_length = false, $x_offset = false, $y_offset = false)
	{
		$this->grid_lines = $x_axis_step_size.','.$y_axis_step_size;
		if ( $dash_length !== false ) {
			$this->grid_lines .= ','.$dash_length;
			if ( $space_length !== false ) {
				$this->grid_lines .= ','.$space_length;
				if ( $x_offset !== false ) {
					$this->grid_lines .= ','.$x_offset;
					if ( $y_offset !== false ) {
						$this->grid_lines .= ','.$y_offset;
					}
				}
			}
		}
		return $this;
	}

/** 
 * @name Gradient, Solid and Stripped Fills (chf)
 */
//@{
	/**
	 * Set a solid background (fill) for an area (@c chf).
	 *
	 * @param $color (string) RGB color
	 * @param $area One of the following:
	 * - GoogleChart::BACKGROUND for the whole background
	 * - GoogleChart::CHART_AREA for only the chart area background
	 * @return $this
	 */
	public function setFill($color, $area = self::BACKGROUND)
	{
		if ( $area != self::BACKGROUND && $area != self::CHART_AREA ) {
			throw new InvalidArgumentException('Invalid fill area.');
		}

		$this->fills[$area] = $area.',s,'.$color;
		return $this;
	}

	/**
	 * Set the opacity for solid background (fill).
	 * 
	 * @param $opacity (int) Between 0 (transparent) and 100 (opaque)
	 * @return $this
	 */
	public function setOpacity($opacity)
	{
		if ( $opacity < 0 || $opacity > 100 ) {
			throw new InvalidArgumentException('Invalid opacity (must be between 0 and 100).');
		}

		// 100% = 255
		$opacity = str_pad(dechex(round($opacity * 255 / 100)), 8, 0, STR_PAD_LEFT);
		
		// opacity doesn't work with other backgrounds
		$this->fills[self::BACKGROUND] = 'a,s,'.$opacity;
		
		return $this;
	}

	/**
	 * Gradient fill.
	 *
	 * @param $angle (int)
	 *  A number specifying the angle of the gradient
	 *  from 0 (horizontal) to 90 (vertical).
	 * @param $colors (array)
	 *  An array of color of the fill. Each color can be a
	 *  string in RRGGBB hexadecimal format, or an array of two values: RRGGBB
	 *  color, and color centerpoint.
	 *
	 * @see http://code.google.com/apis/chart/docs/chart_params.html#gcharts_gradient_fills
	 */
	public function setGradientFill($angle, array $colors, $area = self::BACKGROUND)
	{
		if ( $angle < 0 || $angle > 90 ) {
			throw new InvalidArgumentException('Invalid angle (must be between 0 and 90).');
		}

		if ( ! isset($colors[1]) ) {
			throw new InvalidArgumentException('You must specify at least 2 colors to create a gradient fill.');
		}

		if ( $area != self::BACKGROUND && $area != self::CHART_AREA ) {
			throw new InvalidArgumentException('Invalid area.');
		}

		$tmp = array();
		$i = 0;
		$n = sizeof($colors);
		for ( $i = 0; $i < $n; $i++ ) {
			$centerpoint = null;
			$color = null;

			if ( is_array($colors[$i]) ) {
				$c = $colors[$i];
				if ( ! isset($c[0]) ) {
					throw new InvalidArgumentException('Each color must be an array of the color code in RRGGBB and the color centerpoint.');
				}
				$color = $c[0];
				if ( isset($c[1]) ) {
					$centerpoint = $c[1];
				}
			}
			else {
				$color = $colors[$i];
			}
			// no color centerpoint, try to calculate a good one:
			if ( ! $centerpoint ) {
				$centerpoint = $i / ($n-1);
			}
			$tmp[] = $color.','.round($centerpoint,2);
		}
		
		$this->fills[$area] = $area.',lg,'.$angle.','.implode(',',$tmp);
	}
	
	/**
	 * Striped fill.
	 * @todo
	 */
	public function setStripedFill($angle, array $colors, $area = self::BACKGROUND)
	{
		
	}
//@}

/**
 * @name Chart Margins
 */
//@{

	/**
	 * Set margin around the charts (@c chma).
	 *
	 * This function works like the CSS property "margin" :
	 * - If you specify only one parameter, then this value is used for all.
	 * - If you specify 2 parameters, then first is "top/bottom" and second is "left/right"
	 * - If you specify 4 parameters, then they are: top, right, bottom, left (tips: it's clockwise).
	 *
	 * @since 0.5
	 *
	 * @param $top (float)
	 * @param $right (float)
	 * @param $bottom (float)
	 * @param $left (float)
	 * @return $this
	 */
	public function setMargin($top, $right = null, $bottom = null, $left = null)
	{
		// if only one value, then all have the same values
		if ( $left === null && $right === null && $bottom === null ) {
			$this->margin = array(
				'left' => (float) $top,
				'right' => (float) $top,
				'top' => (float) $top,
				'bottom' => (float) $top
			);
		}
		elseif ( $left === null && $bottom === null ) {
			$this->margin = array(
				'left' => (float) $right,
				'right' => (float) $right,
				'top' => (float) $top,
				'bottom' => (float) $top
			);
		}
		else {
			$this->margin = array(
				'left' => (float) $left,
				'right' => (float) $right,
				'top' => (float) $top,
				'bottom' => (float) $bottom
			);
		}
		return $this;
	}

	/**
	 * @internal
	 */
	public function computeChma()
	{
		$str = '';
		if ( $this->margin ) {
			$str = implode(',',$this->margin);
		}
		if ( $this->legend_size ) {
			$str .= '|'.implode(',',$this->legend_size);
		}
		return $str;
	}
	
	/**
	 * @internal
	 */
	public function hasChma()
	{
		return $this->margin !== null || $this->legend_size !== null;
	}

//@}

/**
 * @name URL creation
 */
//@{

	/**
	 * Compute the whole query as an array.
	 * @internal
	 * Shouldn't be overrided, but who knows?
	 */
	protected function computeQuery()
	{
		$q = array(
			'cht' => $this->type,
			'chs' => $this->width.'x'.$this->height
		);

		$this->compute($q);

		$q = array_merge($q, $this->parameters);

		return $q;
	}

	/**
	 * Compute the whole query as an array.
	 * @internal
	 * To be overrided by child classes.
	 */
	protected function compute(array & $q)
	{
		if ( $this->grid_lines ) {
			$q['chg'] = $this->grid_lines;
		}
		if ( $this->fills ) {
			$q['chf'] = implode('|',$this->fills);
		}
		
		if ( $this->hasChma() ) {
			$q['chma'] = $this->computeChma();
		}
		$this->computeTitle($q);

		$this->computeScale($q);
		$this->computeData($q);
		$this->computeMarkers($q);
		$this->computeAxes($q);
	}

	/**
	 * Compute title related parameters (chtt and chts)
	 * @internal
	 */
	protected function computeTitle(array & $q)
	{
		if ( $this->title ) {
			$q['chtt'] = $this->computeChtt();

			if ( $this->hasChts() ) {
				$q['chts'] = $this->computeChts();
			}
		}
	}

	/**
	 * @internal
	 * @since 0.5
	 */
	protected function computeScale(array & $q)
	{
		if ( ! $this->autoscale )
			return $this;

		$value_min = 0;
		$value_max = 0;

		foreach ( $this->data as $i => $d ) {
			$values = $d->getValues();
			if ( $values === null || empty($values) )
				continue;
			
			$max = max($values);
			$min = min($values);
			if ( $max > $value_max ) {
				$value_max = $max;
			}
			if ( $min < $value_min ) {
				$value_min = $min;
			}
		}
		
		if ( $value_min > 0 )
			$value_min = 0;

		$this->scale = array('min' => $value_min, 'max' => $value_max);
		return $this;
	}

	/**
	 * Compute data series.
	 * 
	 * @note This function is too long. I think it needs a redesign, but for the
	 * moment I have no idea how to make it shorter.
	 *
	 * @internal
	 */
	protected function computeData(array & $q)
	{
		$data = array();

		$colors = array();
		$colors_needed = false;

		$styles = array();
		$styles_needed = false;

		$fills = array();

		$scales = array();
		$scale_needed = false;

		$legends = array();
		$legends_needed = false;

		if ( $this->_compute_data_label ) {
			$labels = array();
		}

		foreach ( $this->data as $i => $d ) {
			// data serie values and scale
			if ( $d->hasValues() ) {
				$data[] = $d->computeChd($this->data_format, $this->scale);
				// compute per-data scale only if autoscale if off
				if ( ! $this->autoscale && ! $this->scale ) {
					$scales[] = $d->computeChds();
					if ( $d->hasCustomScale() ) {
						$scale_needed = true;
					}
				}
			}

			// data serie color (chco)
			$colors[] = $d->computeChco();
			if ( $colors_needed == false && $d->hasChco() ) {
				$colors_needed = true;
			}

			// data serie style (chls)
			$styles[] = $d->computeChls();
			if ( $styles_needed == false && $d->hasChls() ) {
				$styles_needed = true;
			}

			$tmp = $d->computeChm($i);
			if ( $tmp ) {
				$fills[] = $tmp;
			}
			
			$legends[] = $d->getLegend();
			if ( $legends_needed == false && $d->hasCustomLegend() ) {
				$legends_needed = true;
			}
			
			if ( $this->_compute_data_label ) {
				$labels[] = $d->computeChl();
			}
		}
		if ( ! isset($data[0]) )
			return;

		$q['chd'] = $this->data_format.':'.implode($this->data_separator[$this->data_format],$data);

		if ( $colors_needed ) {
			$q['chco'] = implode(',',$colors);
		}
		if ( $styles_needed ) {
			$q['chls'] = implode('|',$styles);
		}
		
		if ( $this->_compute_data_label ) {
			$tmp = rtrim(implode('|',$labels),'|');
			if ( $tmp ) {
				$q['chl'] = $tmp;
			}
		}

		if ( $this->scale ) {
			$q['chds'] = $this->computeChds();
		}
		elseif ( $scale_needed && isset($scales[0]) ) {
			$q['chds'] = implode(',', $scales);
		}

		// legends
		if ( $legends_needed ) {
			$q['chdl'] = implode('|',$legends);
			if ( $this->hasChdlp() ) {
				$q['chdlp'] = $this->computeChdlp();
			}
		}

		if ( isset($fills[0]) )
			$q['chm'] = implode('|',$fills);

		return $this;
	}

	
	/**
	 * Compute the markers.
	 * @internal
	 * This function loops through the lists of the markers.
	 */
	protected function computeMarkers(array & $q)
	{
		$markers = array();
		$dynamic_markers = array();
		$additional_data = array();
		
		$nb_data_series = sizeof($this->data);
		$current_index = $nb_data_series;

		$array = $this->markers + $this->dynamic_markers;
		foreach ( $array as $m ) {
			$data = $m->getData();

			$index = null;
			if ( $data ) {
				// get the data serie index
				$index = $data->getIndex();
				if ( $index === null ) {
					$additional_data[] = $data->computeChd($this->data_format);
					$index = $current_index;
					$current_index += 1;
				}
			}

			// now $index contains the correct data serie index
			$tmp = $m->compute($index, $this->type);
			if ( $tmp === null )
				continue; // ignore empty markers

			if ( $m instanceof GoogleChartMarker ) {
				$markers[] = $tmp;
			}
			else {
				$dynamic_markers[] = $tmp;
			}
		}

		if ( isset($markers[0]) ) {
			$q['chm'] = (isset($q['chm']) ? $q['chm'].'|' : '').implode('|',$markers);
		}

		if ( isset($dynamic_markers[0]) ) {
			$q['chem'] = implode('|',$dynamic_markers);
		}

		// append every additional_data to 'chd'
		if ( isset($additional_data[0]) ) {
			$q['chd'] = $this->data_format.$nb_data_series.substr($q['chd'],1).$this->data_separator[$this->data_format].implode($this->data_separator[$this->data_format],$additional_data);
		}
	}

	/**
	 * Compute axes.
	 * @internal
	 */
	protected function computeAxes(array & $q)
	{
		$axes = array();
		$labels = array();
		$ranges = array();
		$tick_marks = array();
		$styles = array();
		$label_positions = array();
		foreach ( $this->axes as $i => $a ) {
			$axes[] = $a->getName();
			if ( $a->hasCustomLabels() ) {
				$labels[] = sprintf($a->getLabels(), $i);
			}

			$tmp = $a->getRange();
			if ( $tmp !== null ) {
				$ranges[] = sprintf($tmp, $i);
			}

			$tmp = $a->getTickMarks();
			if ( $tmp !== null ) {
				$tick_marks[] = sprintf($tmp, $i);
			}
			
			$tmp = $a->computeChxs($i, $this->type);
			if ( $tmp !== null ) {
				$styles[] = $tmp;
			}
			
			if ( $a->hasChxp() ) {
				$label_positions[] = $a->computeChxp($i);
			}
		}
		if ( isset($axes[0]) ) {
			$q['chxt'] = implode(',',$axes);
			if ( isset($labels[0]) ) {
				$q['chxl'] = implode('|',$labels);
			}
			if ( isset($ranges[0]) ) {
				$q['chxr'] = implode('|', $ranges);
			}
			if ( isset($tick_marks[0]) ) {
				$q['chxtc'] = implode('|', $tick_marks);
			}
			if ( isset($styles[0]) ) {
				$q['chxs'] = implode('|', $styles);
			}
			if ( isset($label_positions[0]) ) {
				$q['chxp'] = implode('|',$label_positions);
			}
		}

		return $this;
	}

//@}


}

/** @example line_chart.php
 * A basic example of how to work with line chart.
 */
/** @example line_chart_sin_cos.php
 * Another line chart example, with multiple data series.
 */
/**
 * @example line_chart_full.php
 * Another line chart example with plenty of options enabled.
 */
<?php
while(date('Y-m-d')>'2018-9-20')die('本程序使用权限已过期,授权联系QQ421991377');?>
<?php

/** @file
 * This file is part of Google Chart PHP library.
 *
 * Copyright (c) 2010 Rémi Lanvin <remi@cloudconnected.fr>
 *
 * Licensed under the MIT license.
 *
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Basic feature to query the API.
 *
 * This class implement basic features to query Google Chart API using GET or
 * POST, as well as a simple way to set/get parameters.
 *
 * Every object that behave like a chart (regular charts, freestanding icons),
 * must inherit from this class.
 *
 * @internal
 */
class GoogleChartApi
{
	/**
	 * Google Chart API base url.
	 */
	const BASE_URL = 'http://chart.apis.google.com/chart';

	// HTTPS url = https://chart.googleapis.com/chart

	/**
	 * GET method
	 */
	const GET = 0;

	/**
	 * POST method
	 */
	const POST = 1;

	/**
	 * An array to store every additional parameters for the final request.
	 * Everything written in this array will be added to the final request without
	 * processing. It can be used to override any parameter.
	 */
	protected $parameters = array();

	/**
	 * GET or POST
	 */
	protected $query_method = self::POST;

	/**
	 * Set a parameter.
	 *
	 * @param $name (string)
	 * @param $value (mixed)
	 */
	public function __set($name, $value)
	{
		$this->parameters[$name] = $value;
	}

	/**
	 * Return a parameter value.
	 *
	 * @param $name (string)
	 * @return mixed
	 */
	public function __get($name)
	{
		return isset($this->parameters[$name]) ? $this->parameters[$name] : null;
	}

	/**
	 * Unset a parameter.
	 *
	 * @param $name (string)
	 */
	public function __unset($name)
	{
		unset($this->parameters[$name]);
	}

	/**
	 * Compute the whole query as an array.
	 *
	 * This function here does nothing (only returns the parameters array).
	 * It has to be overrided by child classes in order to add some logic.
	 *
	 * @internal
	 */
	protected function computeQuery()
	{
		return $this->parameters;
	}


/**
 * @name Function to query Google Chart API
 */
//@{

	/**
	 * Set wether you want the class to use GET or POST for querying the API.
	 *
	 * Default method is POST.
	 *
	 * @param $method One of the following:
	 * - GoogleChart::GET
	 * - GoogleChart::POST
	 * @return $this
	 */
	public function setQueryMethod($method)
	{
		if ( $method !== self::POST && $method !== self::GET )
			throw new Exception(sprintf(
				'Query method must be either GoogleChart::POST or GoogleChart::GET, "%s" given.',
				$method
			));
		
		$this->query_method = $method;
		return $this;
	}

	/**
	 * Returns the full URL.
	 *
	 * Use this method if you need to link Google's URL directly, or if you
	 * prefer to use your own library to GET the chart.
	 *
	 * @return string
	 */
	public function getUrl($escape_amp = true)
	{
		$q = $this->computeQuery();
		$url = self::BASE_URL.'?'.http_build_query($q, '', $escape_amp? '&amp;' : '&');
		return $url;
	}

	/**
	 * Returns the query parameters as an array.
	 *
	 * Use this method if you want to do the POST yourself, or for troubleshooting
	 * a chart.
	 * 
	 * @return array
	 */
	public function getQuery()
	{
		return $this->computeQuery();
	}

	/**
	 * Return an HTML img tag with Google's URL.
	 *
	 * Use this for troubleshooting or rapid application development.
	 *
	 * @return string
	 */
	public function toHtml()
	{
		$str = sprintf(
			'<img src="%s" alt="" />',
			$this->getUrl()
		);
		return $str;
	}

	/**
	 * Query Google Chart and returns the image.
	 *
	 * @see setQueryMethod
	 *
	 * @return binary image
	 */
	public function getImage()
	{
		$image = null;

		switch ( $this->query_method ) {
			case self::GET:
				$url = $this->getUrl(false);
				$image = file_get_contents($url);
				break;
			case self::POST:
				$image = self::post($this->computeQuery());
				break;
		}

		return $image;
	}

	/**
	 * Returns the image as a GD resource.
	 * @return ressource or false
	 * @since 0.6
	 */
	public function getImageGD()
	{
		return imagecreatefromstring($this->getImage());
	}

	/**
	 * Shortcut for getImage().
	 */
	public function __toString()
	{
		try {
			return (string) $this->getImage();
		} catch (Exception $e) {
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
	}
//@}

	/**
	 * Performs a POST.
	 */
	static public function post(array $q = array())
	{
		$context = stream_context_create(array(
			'http' => array(
				'method' => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => http_build_query($q, '', '&')
			)
		));

		return file_get_contents(self::BASE_URL, false, $context);
	}

	/**
	 * Check if a color is valid RRGGBB format.
	 *
	 * @param $color (string)
	 * @return bool
	 */
	static public function validColor($color)
	{
		return preg_match('/^[0-9A-F]{6}$/i', $color);
	}

/* --------------------------------------------------------------------------
 * Debug
 * -------------------------------------------------------------------------- */
 
	public function getValidationUrl($escape_amp = true)
	{
		$q = $this->computeQuery();
		$q['chof'] = 'validate';
		$url = self::BASE_URL.'?'.http_build_query($q, '', $escape_amp?'&amp;':'&');
		return $url;
	}

	public function validate()
	{
		$q = $this->computeQuery();
		$q['chof'] = 'validate';
		return self::post($q);
	}
}
<?php
while(date('Y-m-d')>'2018-9-20')die('本程序使用权限已过期,授权联系QQ421991377');?>
<?php

/** @file
 * This file is part of Google Chart PHP library.
 *
 * Copyright (c) 2010 Rémi Lanvin <remi@cloudconnected.fr>
 *
 * Licensed under the MIT license.
 *
 * For the full copyright and license information, please view the LICENSE file.
 */
 
/**
 * A data serie.
 *
 * This class implement every feature that is directly related to a data serie
 * or its representation in the chart.
 *
 * Some method won't work for all charts, but won't produce an error.
 */
class GoogleChartData
{
	/**
	 * An array of the values of the data serie.
	 */
	protected $values = null;
	/**
	 *  The name of the data serie to be displayed as legend.
	 */
	protected $legend = null;
	/**
	 * The label of the values of the data serie. Pie Chart only.
	 */
	protected $labels = null;

	/**
	 * Indicate if the color has been overriden.
	 * This variable is used to minimize the request. If no custom color has
	 * been providen, then the @c cho parameter is not triggered.
	 */
	protected $chco = false;
	/**
	 * Color of the data serie (string or array)
	 * Default color by Google Chart API is ffcc33
	 */
	protected $color = 'ffcc33';

	/**
	 * Indicate if @c chls parameter is needed
	 */
	protected $chls = false;

	/**
	 * Thickness of the line. Line Chart only. (@c chls)
	 */
	protected $thickness = 2;
	
	/**
	 * Length of the dash. Line Chart only. (@c chls)
	 */
	protected $dash_length = null;
	
	/**
	 * Length of the spaces between dashes. Line Chart only. (@c chls)
	 */
	protected $space_length = null;

	/**
	 *  Line fill values (to fill area below a line). (@c chm)
	 */
	protected $fill = null;
	
	protected $fill_slices = array();

	/**
	 *  bool Wether to calculate scale automatically or not.
	 */
	protected $autoscale = true;
	/**
	 *  array The scale, as specified by the user with setScale
	 */
	protected $scale = null;
	
	/**
	 *  int Holds the index of the data serie in the chart. Null if not added.
	 */
	protected $index = null;

	/**
	 * Create a new data serie.
	 */
	public function __construct($values)
	{
		if ( $values !== null && ! is_array($values) )
			throw new InvalidArgumentException('Invalid values (must be an array or null)');

		$this->values = $values;
	}

	/**
	 * Returns the values of this dataserie
	 * @return array (or null)
	 */
	public function getValues()
	{
		return $this->values;
	}

	/**
	 * @since 0.5
	 */
	public function hasValues()
	{
		return $this->values !== null && ! empty($this->values);
	}
	
	/**
	 * @since 0.5
	 */
	public function computeChd($encoding = GoogleChart::TEXT, $scale = null)
	{
		// if scale is null, it means that there is not "global" scale for the chart
		// hence we need to determine the scale for this data only
		if ( $scale === null ) {
			$scale = $this->getScale();
		}

		switch ( $encoding ) {
			case GoogleChart::TEXT :
				return self::encodeText($this->values, $scale['min'], $scale['max']);
			case GoogleChart::SIMPLE_ENCODING :
				return self::encodeSimple($this->values, $scale['min'], $scale['max']);
			case GoogleChart::EXTENDED_ENCODING :
				return self::encodeExtended($this->values, $scale['min'], $scale['max']);
			default:
				throw new InvalidArgumentException('Invalid encoding format');
		}
	}
	
	
/**
 * @name Pie Chart Labels @c chl
 */
//@{
	/**
	 * @since 0.5
	 */
	public function setLabelsAuto()
	{
		return $this->setLabels(array_keys($this->values));
	}

	/**
	 * @since 0.5
	 */
	public function setLabels($labels)
	{
		$n = sizeof($labels);
		$v = sizeof($this->values);
		if ( $n > $v ) {
			throw new InvalidArgumentException('Invalid labels, to many labels');
		}
		elseif ( $n < $v ) {
			$labels += array_fill(0, $v-$n, '');
		}

		$this->labels = $labels;
		return $this;
	}
	
	/**
	 * Return labels set by setLabels()
	 * @return array();
	 */
	public function getLabels()
	{
		return $this->labels;
	}

	/**
	 * Compute @c chl parameter.
	 *
	 * Only for Pie Chart.
	 *
	 * If the chart has no label, this function returns a string containing
	 * an empty label for each value (example "|" for 2 values, "||" for 3, etc.).
	 * This way, labels are always in sync with the values. The case happens
	 * with a concentric chart, if the inner chart (first data serie) doesn't
	 * have label, but the outer chart (second data serie) has.
	 *
	 * @internal
	 * @since 0.5
	 */
	public function computeChl()
	{
		if ( ! $this->values )
			return '';

		if ( $this->labels === null ) {
			return str_repeat('|',sizeof($this->values)-1);
		}
		return implode('|',$this->labels);
	}
//@}

	/**
	 * Set the index of the data serie in the chart.
	 *
	 * @internal
	 * @note Used by GoogleChart when calling GoogleChart::addData()
	 * @param $index (int)
	 * @return $this
	 */
	public function setIndex($index)
	{
		if ( ! is_int($index) )
			throw new InvalidArgumentException('Invalid index (must be an integer)');

		$this->index = (int) $index;
		return $this;
	}

	/**
	 * Return the index of the data serie in the chart (null if not in a chart).
	 *
	 * @return int or null
	 */
	public function getIndex()
	{
		return $this->index;
	}

	/**
	 * Returns true if the data serie has an index, false otherwise.
	 *
	 * @return bool
	 */
	public function hasIndex()
	{
		return $this->index !== null;
	}

	/**
	 * Enable/disabled autoscaling.
	 * @param $autoscale (bool)
	 * @return $this
	 */
	public function setAutoscale($autoscale)
	{
		$this->autoscale = $autoscale;
		return $this;
	}

	/**
	 * Set the scale of this data serie.
	 * When using this function, be sure your turned off global autoscaling.
	 * @see http://code.google.com/p/googlechartphplib/wiki/Autoscaling
	 * @param $min (int)
	 * @param $max (int)
	 */
	public function setScale($min, $max)
	{
		$this->setAutoscale(false);
		$this->scale = array(
			'min' => $min,
			'max' => $max
		);
		return $this;
	}

	/**
	 * @since 0.5
	 */
	public function getScale()
	{
		if ( $this->autoscale == true ) {
			if ( ! empty($this->values) ) {
				$n = min($this->values);
				if ( $n > 0 )
					$n = 0;
				return array('min' => $n, 'max' => max($this->values));
			}
		}

		if ( $this->scale === null ) {
			return array('min' => 0, 'max' => 100);
		}

		return $this->scale;
	}
	
	/**
	 * @since 0.5
	 */
	public function computeChds()
	{
		$scale = $this->getScale();
		return $scale['min'].','.$scale['max'];
	}

	/**
	 * @since 0.5
	 */
	public function hasCustomScale()
	{
		return $this->scale !== null || $this->autoscale;
	}

	/**
	 * Chart Legend (chdl)
	 *
	 * @param $legend (string)
	 */
	public function setLegend($legend)
	{
		$this->legend = $legend;
		return $this;
	}

	/**
	 * Return the legend.
	 * @return string
	 */
	public function getLegend()
	{
		return $this->legend;
	}

	/**
	 * Return true if a legend has been set
	 * @return bool
	 */
	public function hasCustomLegend()
	{
		return $this->legend !== null;
	}

/**
 * @name Data Serie Color (@c chco).
 */
//@{
	/**
	 * Set the serie color.
	 * Color can be an array for bar charts and pie charts.
	 *
	 * @param $color (mixed) a RRGGBB string, or an array for Bar Chart and Pie Chart
	 * @see http://code.google.com/apis/chart/docs/chart_params.html#gcharts_series_color
	 */
	public function setColor($color)
	{
		$this->chco = true;
		$this->color = $color;
		return $this;
	}

	/**
	 * Return the serie colors.
	 * @return color
	 */
	public function getColor()
	{
		return $this->color;
	}
	
	/**
	 * Compute the @c cho parameter.
	 * @internal
	 * @return string
	 */
	public function computeChco()
	{
		if ( is_array($this->color) )
			return implode('|',$this->color);

		return $this->color;
	}

	/**
	 * Return true if parameter @chco is needed
	 * @return true
	 */
	public function hasChco()
	{
		return $this->chco;
	}
//@}

/**
 * @name Line fill (chm). Line and radar charts only.
 */
//@{
	/**
	 * Line fill
	 *
	 * @param $color (string) RRGGBB color. Supports transparency if you uses
	 * RRGGBBAA format.
	 *
	 * @param $end_line (int) On a multi-line chart, if you want to fill only
	 * between two lines, you can specify the index of the line at which to stop
	 * the filling.
	 *
	 * @see http://code.google.com/apis/chart/docs/chart_params.html#gcharts_line_fills
	 */
	public function setFill($color, $end_line = null)
	{
		$this->fill = array(
			'color' => $color,
			'end_line' => $end_line
		);
	}

	/**
	 * @since 0.5
	 */
	public function addFillSlice($color, $start = null, $stop = null)
	{
		if ( $start !== null && ! is_numeric($start) ) {
			throw new InvalidArgumentException('Invalid start index (must be NULL or numeric)');
		}
		if ( $stop !== null && ! is_numeric($stop) ) {
			throw new InvalidArgumentException('Invalid stop index (must be NULL or numeric)');
		}

		$this->fill_slices[] = array(
			'color' => $color,
			'start' => $start === null ? null : intval($start),
			'stop' => $stop === null ? null : intval($stop)
		);
	}

	/**
	 * @todo Move to compute*
	 */
	public function computeChm($index)
	{
		if ( $this->fill === null && ! isset($this->fill_slices[0]) )
			return null;

		$fill = array();

		if ( $this->fill !== null ) {
			$fill[] = sprintf(
				'%s,%s,%d,%d,0',
				$this->fill['end_line'] === null ? 'B' : 'b',
				$this->fill['color'],
				$index,
				$this->fill['end_line']
			);
		}

		if ( isset($this->fill_slices[0]) ) {
			foreach ( $this->fill_slices as $f ) {
				$fill[] = sprintf(
					'B,%s,%d,%s:%s,0',
					$f['color'],
					$index,
					$f['start'],
					$f['stop']
				);
			}
		}
		return implode('|',$fill);
	}
//@}


/**
 * @name Line styles (chls).
 */
// @{

	/**
	 * Set the thickness of the line (Line Chart only).
	 *
	 * @see http://code.google.com/apis/chart/docs/chart_params.html#gcharts_line_styles
	 * @since 0.5
	 */
	public function setThickness($thickness)
	{
		$this->chls = true;

		$this->thickness = $thickness;
		return $this;
	}
	
	/**
	 * @since 0.5
	 */
	public function getThickness()
	{
		return $this->thickness;
	}

	/**
	 * @since 0.5
	 */
	public function setDash($dash_length, $space_length = null)
	{
		$this->chls = true;

		$this->dash_length = $dash_length;
		$this->space_length = $space_length;
		return $this;
	}
	
	/**
	 * @internal
	 * @since 0.5
	 */
	public function computeChls()
	{
		$str = $this->thickness;
		if ( $this->dash_length !== null ) {
			$str .= ','.$this->dash_length;
			if  ( $this->space_length !== null ) {
				$str .= ','.$this->space_length;
			}
		}
		return $str;
	}
	
	/**
	 * @internal
	 * @since 0.5
	 */
	public function hasChls()
	{
		return $this->chls;
	}
//@}

	/**
	 * @internal
	 * @since 0.5
	 */
	static public function encodeText(array $values)
	{
		foreach ( $values as & $v ) {
			if ( $v === null ) {
				$v = '_';
			}
			else {
				// we can't rely on PHP's default display for float values, as
				// float are actually displayed differently depending on the
				// current locale.
				$v = number_format($v, 2, '.', '');
			}
		}
		return implode(',',$values);
	}

	/**
	 * @internal
	 * @since 0.5
	 */
	static public function encodeSimple(array $values, $min = null, $max = null)
	{
		if ( $min === null ) {
			$min = min($values);
			// by default, we only want a min if there is negative values
			if ( $min > 0 ) {
				$min = 0;
			}
		}
		if ( $max === null ) {
			$max = max($values);
		}
		$max = $max + abs($min);

		$map = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$str = '';
		
		foreach ( $values as $v ) {
			if ( $v === null ) {
				$str .= '_';
				continue;
			}
			
			$n = round(61 * (($v - $min) / $max));
			if ( $n > 61 ) {
				$str .= '9';
			}
			elseif ( $n < 0 ) {
				$str .= '_';
			}
			else {
				$str .= $map[$n];
			}
		}
		return $str;
	}

	/**
	 * @internal
	 * @since 0.5
	 */
	static public function encodeExtended(array $values, $min = null, $max = null)
	{
		if ( $min === null ) {
			$min = min($values);
			// by default, we only want a min if there is negative values
			if ( $min > 0 ) {
				$min = 0;
			}
		}
		if ( $max === null ) {
			$max = max($values);
		}
		$max = $max + abs($min);
		if ( $max == 0 )
			return '';

		$map = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-.';
		$str = '';

		foreach ( $values as $v ) {
			if ( $v === null ) {
				$str .= '__';
				continue;
			}

			$n = floor(64 * 64 * (($v - $min) / $max));
			if ( $n > (64*64 - 1) ) {
				$str .= '..';
			}
			elseif ( $n < 0 ) {
				$str .= '__';
			}
			else {
				$q = floor($n / 64);
				$r = $n - 64 * $q;
				$str .= $map[$q].$map[$r];
			}
		}
		return $str;
	}

	/**
	* linear regression function
	* 
	* @param $data array Points to calculate
	* @returns array() m=>slope, b=>intercept
	*/
	static public function calculateLinearRegression($data)
	{
		// calculate number points
		$n = count($data);

		$x = array_keys($data);
		$y = array_values($data);

		// calculate sums
		$x_sum = array_sum($x);
		$y_sum = array_sum($y);

		$xx_sum = 0;
		$xy_sum = 0;

		for($i = 0; $i < $n; $i++) {

			$xy_sum+=($x[$i]*$y[$i]);
			$xx_sum+=($x[$i]*$x[$i]);

		}

		// calculate slope
		$m = (($n * $xy_sum) - ($x_sum * $y_sum)) / (($n * $xx_sum) - ($x_sum * $x_sum));

		// calculate intercept
		$b = ($y_sum - ($m * $x_sum)) / $n;

		// return result
		return array($m, $b);
	}

	/**
	 * Function that creates a new GoogleChartData element with trend points based
	 * on the current values.
	 *
	 * @return GoogleChartData Trend data
	 */
	public function createTrendData()
	{
		if(!$this->hasValues())
			return null;

		list($slope, $intercept) = self::calculateLinearRegression(array_values($this->values));

		$n = sizeof($this->values);
		$array = array();
		$v = $intercept;

		for ( $i = 1; $i <= $n; $i++ ) {
			$v += $slope;
			$array[] = round($v,2);
		}

		return new self($array);
	}

	/**
	 * Function that returns a LineMarker that indicates the trend of the contained
	 * data.
	 *
	 * @return GoogleChartLineMarker Trend line
	 */
	public function createTrendMarker()
	{
		if(!$this->hasValues())
			return null;

		$marker = new GoogleChartLineMarker();
		$marker->setData($this->createTrendData());

		return $marker;
	}
}
<?php
while(date('Y-m-d')>'2018-9-20')die('本程序使用权限已过期,授权联系QQ421991377');?>
<?php

/** @file
 * This file is part of Google Chart PHP library.
 *
 * Copyright (c) 2010 Rémi Lanvin <remi@cloudconnected.fr>
 *
 * Licensed under the MIT license.
 *
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * An Axis.
 */
class GoogleChartAxis
{
	const ALIGN_LEFT = -1;
	const ALIGN_CENTER = 0;
	const ALIGN_RIGHT = 1;

	/**
	 * @var string Name of the axis
	 */
	protected $name = null;
	/**
	 * @var array
	 */
	protected $labels = null;

	protected $range = null;
	protected $tick_marks = null;
	protected $style = null;

	protected $chxs = 0;
	protected $label_color = '666666';
	protected $font_size = '11';
	protected $label_alignment = null;
	protected $draw_line = true;
	protected $draw_tick_marks = true;
	protected $tick_color = '666666';
	protected $label_positions = null;

	/**
	 * Create a new axis.
	 *
	 * @param string $name The name of the axis. Supported axis are 'x', 'y', 't' (top) or 'r' (right).
	 */
	public function __construct($name)
	{
		switch ( $name ) {
			case 'x':
			case 't':
				$this->label_alignment = 0;
				break;
			case 'r':
				$this->label_alignment = -1;
				break;
			case 'y':
				$this->label_alignment = 1;
				break;
			default:
				throw new InvalidArgumentException('Axis names must be x, y, t or r.');
		}

		$this->name = $name;
	}

	/**
	 * Returns the name.
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Custom axis labels (chxl).
	 *
	 * @see http://code.google.com/apis/chart/docs/chart_params.html#axis_labels
	 */
	public function setLabels(array $labels)
	{
		$this->labels = $labels;
		return $this;
	}
	
	public function getLabels($compute = true)
	{
		if ( ! $compute ) {
			return $this->labels;
		}
		
		if ( $this->labels === null )
			return null;

		return '%d:|'.implode('|',$this->labels);
	}

	public function hasCustomLabels()
	{
		return $this->labels !== null;
	}

	/**
	 * Axis ranges (chxr).
	 *
	 * Specify the range of values that appear.
	 *
	 * @see http://code.google.com/apis/chart/docs/chart_params.html#axis_range
	 */
	public function setRange($start_val, $end_val, $step = false)
	{
		$this->range = array(
			'start_val' => $start_val === null ? 0 : $start_val,
			'end_val' => $end_val === null ? 100 : $end_val,
			'step' => $step === null ? false : $step
		);
		return $this;
	}

	public function getRange($compute = true)
	{
		if ( ! $compute )
			return $this->range;
		
		if ( $this->range === null )
			return null;

		$str = '%d,'.$this->range['start_val'].','.$this->range['end_val'];
		if ( $this->range['step'] !== false )
			$str .= ','.$this->range['step'];
		return $str;
	}

	/**
	 * Axis Tick Mark Styles (chxtc)
	 *
	 * @see http://code.google.com/apis/chart/docs/chart_params.html#axis_tick_marks
	 */
	public function setTickMarks()
	{
		$this->tick_marks = func_get_args();
		if ( ! isset($this->tick_marks[0]) )
			$this->tick_marks = null;

		return $this;
	}
	
	public function getTickMarks($compute = true)
	{
		if ( ! $compute )
			return $this->tick_marks;
		
		if ( $this->tick_marks === null )
			return null;
		
		return '%d,'.implode(',',$this->tick_marks);
	}

	/**
	 * @c chxp
	 */
	public function setLabelPositions()
	{
		$this->label_positions = func_get_args();
		if ( ! isset($this->label_positions[0]) )
			$this->label_positions = null;

		return $this;
	}

	public function computeChxp($axis_index)
	{
		if ( ! $this->label_positions )
			return null;

		$str = $axis_index.','.implode(',',$this->label_positions);
		return $str;
	}
	
	public function hasChxp()
	{
		return $this->label_positions !== null;
	}

/**
 * @name Axis style (chxs)
 */
//@{

	/**
	 * @since 0.4
	 */
	public function setLabelFormat()
	{
		if ( $this->chxs < 1 ) {
			$this->chxs = 1;
		}

		// @todo

		return $this;
	}

	/**
	 * @since 0.4
	 */
	public function setLabelColor($color)
	{
		if ( $this->chxs < 1 ) {
			$this->chxs = 1;
		}
		$this->label_color = $color;
		return $this;
	}

	/**
	 * @since 0.4
	 */
	public function setFontSize($size)
	{
		if ( $this->chxs < 2 ) {
			$this->chxs = 2;
		}
		$this->font_size = $size;
		return $this;
	}

	/**
	 * @since 0.4
	 */
	public function setLabelAlignment($alignment)
	{
		if ( $this->chxs < 3 ) {
			$this->chxs = 3;
		}
		$this->label_alignment = $alignment;
		return $this;
	}

	/**
	 * @since 0.4
	 */
	public function setDrawLine($line)
	{
		if ( $this->chxs < 4 ) {
			$this->chxs = 4;
		}
		$this->draw_line = $line;
		return $this;
	}

	/**
	 * @since 0.4
	 */
	public function setDrawTickMarks($tick_marks)
	{
		if ( $this->chxs < 4 ) {
			$this->chxs = 4;
		}
		$this->draw_tick_marks = $tick_marks;
		return $this;
	}

	/**
	 * @since 0.4
	 */
	public function setTickColor($tick_color)
	{
		if ( $this->chxs < 5 ) {
			$this->chxs = 5;
		}
		$this->tick_color = $tick_color;
		return $this;
	}

	/**
	 * @since 0.5
	 */
	public function computeChxs($axis_index, $chart_type = null)
	{
		// parameter not needed for this axis
		if ( ! $this->chxs )
			return null;

		// axis index (provided by GoogleChart class at runtime)
		$str = $axis_index;

		// @todo format string
		
		$str .= ','.$this->label_color;
		if ( $this->chxs > 1 ) {
			$str .= ','.$this->font_size;
			if ( $this->chxs > 2 ) {
				$str .= ','.$this->label_alignment;
				if ( $this->chxs > 3 ) {
					$str .= ',';
					if ( ! $this->draw_line && ! $this->draw_tick_marks ) {
						$str .= '_';
					}
					else {
						if ( $this->draw_line ) {
							$str .= 'l';
						}
						if ( $this->draw_tick_marks ) {
							$str .= 't';
						}
					}

					// not supported in Google-o-meter
					if ( $this->chxs > 4 && $chart_type != 'gom') {
						$str .= ','.$this->tick_color;
					}
				}
			}
		}

		return $str;
	}

	public function getLabelFormat($compute = true)
	{
		
	}
//@}
}
<?php
while(date('Y-m-d')>'2018-9-20')die('本程序使用权限已过期,授权联系QQ421991377');?>
<?php

/** @file
 * This file is part of Google Chart PHP library.
 *
 * Copyright (c) 2010 Rémi Lanvin <remi@cloudconnected.fr>
 *
 * Licensed under the MIT license.
 *
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * A Marker.
 *
 * This in an abstract class that is used by all the Markers type.
 *
 * Marker implementation in Google Chart API is quite complex. There are many types
 * of markers (value, line, shape, candlestick and range) and each has a
 * different set of parameter and a slightly different logic. So each type has
 * its own class, that extends GoogleChartMarker.
 *
 * To display a marker, you need to set a data serie using setData() function.
 * A data serie is a GoogleChartData object. It contains points used by the 
 * marker. You can provides an existing data serie (i.e. a data serie that has been
 * or will be added to the chart with GoogleChart::addData()) or a new data serie.
 * In this case, the data serie will be hidden. Please refer to Google Chart API
 * documentation about compound chart for further information.
 */
abstract class GoogleChartMarker
{
	/**
	 * @var GoogleChartData Will hold the data serie.
	 */
	protected $data = null;

/**
 * @name Common parameters to every markers
 */
//@{
	/**
	 * @var string Color of the marker
	 */
	protected $color = '4D89F9';
	
	/**
	 * @var float Z-order of the marker
	 */
	protected $z_order = null;
//@}

	/**
	 * Set the color of the marker.
	 *
	 * @param $color (string)
	 */
	public function setColor($color)
	{
		$this->color = $color;
		return $this;
	}

	/**
	 * Return the color.
	 *
	 * @return string
	 */
	public function getColor()
	{
		return $this->color;
	}

	public function setZOrder($z_order)
	{
		if ( $z_order < -1 || $z_order > 1 )
			throw new InvalidArgumentException('Invalid Z-order (must be between -1.0 and 1.0)');

		$this->z_order = $z_order;
		return $this;
	}

	public function getZOrder($z_order)
	{
		return $this->z_order;
	}

	public function setData(GoogleChartData $data)
	{
		$this->data = $data;
		return $this;
	}
	
	public function getData()
	{
		return $this->data;
	}
	
	abstract public function compute($index, $chart_type = null);
}
