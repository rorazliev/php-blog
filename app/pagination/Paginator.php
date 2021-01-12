<?php

namespace App\Pagination;

class Paginator {
  /**
   * The amount of items to be paginated.
   *
   * @var int
   */
  protected $amountItems;
  /**
   * The amount of items to be displayed per page.
   *
   * @var int
   */
  protected $perPage;
  /**
   * The number of the current page.
   *
   * @var int
   */
  protected $currentPage;
  /**
   * The total number of pages.
   *
   * @var int
   */
  protected $amountPages;
  /**
   * The amount of navigation links to be displayed.
   *
   * @var int
   */
  protected $toBeDisplayed = 4;
  /**
   * Create a new Paginator instance.
   *
   * @param int $amountItems
   * @param int|null $currentPage
   * @param int $perPage
   */
  public function __construct(int $amountItems, ?int $currentPage = null, int $perPage = 10) {
    $this->amountItems = $amountItems;
    $this->perPage = $perPage;
    $this->amountPages = $this->countPages();
    $this->currentPage = $this->setCurrentPage($currentPage);
  }
  /**
   * Get a string of the paginatio panel.
   *
   * @return string
   */
  public function render(): string {
    list($start, $end) = $this->getLimits();
    $links = '';
    $html = '<nav class="pagination"><ul>';

    for ($page = $start; $page <= $end; $page++) {
      $isCurrent = $page == $this->currentPage ? true : false;
      $links .= $this->toHtml($page, $isCurrent);
    }
    $html .= "{$links}</ul></nav>";
    return $html;
  }
  /**
   * Get an html representation of the link.
   *
   * @param int $pageNumber
   * @param bool $isCurrent
   * @return string
   */
  protected function toHtml(int $pageNumber, bool $isCurrent = false): string {
    if ($isCurrent) {
      return "<li class='page-item active'><span>{$pageNumber}</span></li>";
    }
    return "<li class='page-item'><a href='/page/{$pageNumber}'>{$pageNumber}</a></li>";
  }
  /**
   * Get the limits of links to be displayed.
   *
   * @return array
   */
  protected function getLimits(): array {
    $left = $this->currentPage - round($this->toBeDisplayed / 2);
    $start = $left > 0 ? $left : 1;
    if ($start + $this->toBeDisplayed <= $this->amountPages) {
      $end = $start > 1 ? $start + $this->toBeDisplayed : $this->toBeDisplayed;
    }
    else {
      $end = $this->amountPages;
      $start = $this->amountPages - $this->toBeDisplayed > 0 ? $this->amountPages - $this->toBeDisplayed : 1;
    }
    return [$start, $end];
  }
  /**
   * Count the amount of pages.
   *
   * @return void
   */
  protected function countPages(): int {
    return ceil($this->amountItems / $this->perPage);
  }
  /**
   * Define the number of the current page.
   *
   * @param int|null $currentPage
   * @return void
   */
  protected function setCurrentPage(?int $currentPage = null): int {
    if (is_null($currentPage)) {
      $currentPage = 1;
    }
    if ($currentPage > 0 && $currentPage > $this->amountPages) {
      $currentPage = $this->amountPages;
    }
    return $currentPage;
  }
}
