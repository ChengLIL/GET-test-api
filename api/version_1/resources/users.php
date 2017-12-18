<?php

class Users extends Resource {

	public $accept = array(
		'text/plain',
		'text/html',
		'application/json'
	);

	/*
	 * GET /users
	 */
	public function get() {
		$this->accept = array('application/jsons');

		$users = Database::select('SELECT * FROM user');

		return $this->response->body(200, $users);
	}

	/*
	 * GET /users/1
	 */
	public function detail() {
        $user = Database::select('SELECT * FROM user WHERE id = ?', array(
            $this->request->url->id
        ));

        return $this->response->body(200, $user);
	}

	/*
	 * POST /users
	 */
	public function post() {
        $post_data = $this->request->url->query;
        $post_name = empty($post_data['name']) ? '' : $post_data['name'];
        $post_email = empty($post_data['email']) ? '' : $post_data['email'];
        if (!empty($post_name.$post_email)) {
            $user_id = Database::insert('INSERT INTO user (`id`, `name`, `email`) VALUES (NULL, ?, ?)', array(
                $post_name, $post_email
            ));
            return $this->response->body(201, $user_id);
        } else {
            return $this->response->status(406, 'user data empty !');
        }
	}

	/*
	 * DELETE /users/1
	 */
	public function delete() {
        $result = Database::remove('DELETE FROM user WHERE id = ?', array(
            $this->request->url->id
        ));
        if (!$result)
            return $this->response->body(204, $result);
        else
            return $this->response->status(200, 'user delete successful !');
    }
}