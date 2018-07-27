<?php

	class contrast
	{
		# 常用中文分词
		private static $condition = [' ',',','，','.','。','?','？','!','！',';','；']; 
		
		# 字符串截取后的数组
		private $arr = [];
		
		# 截取后剩余的字符串
		private $surplus_str = '';
		
		# 截取的位置
		private $p = [];
		
		# 记录位置的v
		private $v = [];
				
		# 开始干活了
		public function begin($str)
		{
			$this->surplus_str = $str;
			
			while (strlen($this->surplus_str) > 3) {
				
				$this->p = [];
				
				$this->v = [];
				
				$this->group();
				
			}
			return $this->arr;
		}
		
		# 进行分词
		protected function group()
		{
			$condition = self::$condition;
			
			foreach ($condition as &$v) {
				
				# 找到对应的位置
				$position = strpos($this->surplus_str,$v,0);
				
				
				if ($position){
					# 记录位置
					array_push($this->p,$position);
					
					$this->v[$position] = $v;
				}
				
			}
			# 数组重新排序
			sort($this->p);
			
			$start_v = $this->v[$this->p[0]];
				
			if (count($this->p) > 0){
				
				# 找到第一个字符的位置
				$position = strpos($this->surplus_str,$start_v,0);
					
				$sub_str = substr($this->surplus_str, 0, $position);
			
				$this->surplus_str = substr($this->surplus_str,$position);
					
				# 解决中文截取乱码和多余字符
				$this->surplus_str = mb_substr($this->surplus_str,1);
					
				# 加入字符串
				array_push($this->arr, $sub_str);
					
				# 加入分词标点符号
				array_push($this->arr, $start_v);
			}

		}
		
	}

