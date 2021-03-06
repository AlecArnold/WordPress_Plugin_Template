<?php
/**
 * Includes the class for handling plugin templates.
 *
 * @package Plugin_Name
 */

namespace Plugin_Name\Core;

use Plugin_Name;

/**
 * Handles individual template within this plugin.
 */
class Template {

	/**
	 * Stores the path to the file.
	 *
	 * @var string The path to the file.
	 */
	protected $template_file;

	/**
	 * Stores the path to the template path.
	 *
	 * @var string The path to the template path.
	 */
	protected $template_path;

	/**
	 * Stores whether the template path has been set.
	 *
	 * @var bool Whether the template path has been set.
	 */
	protected $is_template_path_set = false;

	/**
	 * Stores the variables that are included within the template.
	 *
	 * @var array The template variables.
	 */
	protected $template_variables;

	/**
	 * Handles the construction process for the view.
	 *
	 * @param string $template_file The path to the template file.
	 * @param array  $variables     An associative array of variables that need to be include within the view.
	 */
	public function __construct( $template_file, $variables = array() ) {
		$this->set_template_file( $template_file );
		$this->add_template_variables( $variables );
	}

	/**
	 * Handle the magic method to add the variables to this view.
	 *
	 * @param string $key   The variable name.
	 * @param string $value The variable value.
	 */
	public function __set( $key, $value ) {
		$this->add_template_variable( $key, $value );
	}

	/**
	 * Sets the file for the template that will be rendered.
	 *
	 * @param string $template_file The template file to be rendered.
	 */
	public function set_template_file( $template_file ) {
		$this->template_file = $template_file;
	}

	/**
	 * Determines whether the template file has been set.
	 *
	 * @return bool Whether the template file has been set.
	 */
	public function has_template_file() {
		return ! empty( $this->get_template_file() );
	}

	/**
	 * Retrieves the template file that has been set.
	 *
	 * @return string The defined template file.
	 */
	public function get_template_file() {
		return $this->template_file;
	}

	/**
	 * Determines whether the provided template path is valid.
	 *
	 * @return bool Whether the template path is valid.
	 */
	public function is_template_path_valid() {
		return $this->has_template_file() && file_exists( $this->get_template_path() );
	}

	/**
	 * Retrieves the path to the template file.
	 *
	 * @param string $template_path The path to the template file.
	 */
	public function set_template_path( $template_path ) {
		$this->template_path        = $template_path;
		$this->is_template_path_set = true;
	}

	/**
	 * Retrieves the path to the template file.
	 *
	 * @return string The path to the template file.
	 */
	public function get_template_path() {
		if ( ! $this->is_template_path_set ) {
			$this->set_template_path( Plugin_Name::get_plugin_path( 'template/' . $this->get_template_file() ) );
		}
		return $this->template_path;
	}

	/**
	 * Sets multiple variables that are to be included within the template.
	 *
	 * @param array $variables The variables to include within the template.
	 */
	public function add_template_variables( $variables ) {
		foreach ( $variables as $key => $value ) {
			$this->add_template_variable( $key, $value );
		}
	}

	/**
	 * Sets an individual variable that is to be included within the template.
	 *
	 * @param string $key   The name of the variables that will be accessible in the template.
	 * @param mixed  $value The value of the variable.
	 */
	public function add_template_variable( $key, $value ) {
		$this->template_variables[ $key ] = $value;
	}

	/**
	 * Determines whether there are variables to include within the template.
	 *
	 * @return bool Whether there are variables to include within the template.
	 */
	public function has_template_variables() {
		return ! empty( $this->template_variables );
	}

	/**
	 * Retrieves all of the variables to be included within the template.
	 *
	 * @return array The variables to be included within the template.
	 */
	public function get_template_variables() {
		return $this->template_variables;
	}

	/**
	 * Retrieves the content for the template.
	 *
	 * @return string The content for the template.
	 */
	public function get_template_content() {
		ob_start();
		$this->render();
		return ob_get_clean();
	}

	/**
	 * Renders the template.
	 *
	 * @return bool Whether the template was successfully rendered.
	 */
	public function render() {

		// Ensure that the template file exists.
		if ( $this->is_template_path_valid() ) {

			// Ensure that there are variables to include in the template.
			if ( $this->has_template_variables() ) {
				extract( $this->get_template_variables() ); // phpcs:ignore
			}

			// Renders the template.
			include $this->get_template_path();

			// Set the response to return that the template was rendered successfully.
			$response = true;

		} else { // Set the response to return that the template failed to render.
			$response = false;
		}
		return $response;
	}

}
