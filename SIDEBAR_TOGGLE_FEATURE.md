# Admin Sidebar Toggle Feature

## Overview
Added a hide/unhide functionality to the admin panel sidebar menu, allowing admins to collapse the sidebar for more screen space.

## Features Implemented

### 1. Toggle Button
- **Location**: Fixed position at the top-left of the screen
- **Design**: Circular button with hamburger menu icon (☰)
- **Color**: Matches the sidebar theme (#1e293b)
- **Hover Effect**: Turns blue (#2563eb) and scales up
- **Position**: 
  - When sidebar is visible: Right next to sidebar (left: 250px)
  - When sidebar is hidden: Left edge of screen (left: 20px)

### 2. Sidebar Behavior
- **Default State**: Visible (240px width)
- **Collapsed State**: Slides off-screen to the left (left: -240px)
- **Animation**: Smooth 0.3s transition
- **Persistent State**: Uses localStorage to remember user preference across page reloads

### 3. Content Area Adjustment
- **Default**: 240px left margin (to accommodate sidebar)
- **Expanded**: 0px left margin when sidebar is hidden (full screen width)
- **Animation**: Smooth 0.3s transition

### 4. JavaScript Functionality
```javascript
toggleSidebar() - Toggles the collapsed state
- Adds/removes 'collapsed' class from sidebar
- Adds/removes 'expanded' class from content area
- Adds/removes 'shifted' class from toggle button
- Saves state to localStorage

DOMContentLoaded event - Restores saved state on page load
- Checks localStorage for saved preference
- Applies appropriate classes if sidebar was collapsed
```

## Files Modified

### 1. admin_dashboard.php
- Added `id="adminSidebar"` to sidebar div
- Added toggle button HTML with onclick handler
- Added `id="mainContent"` to content div
- Added JavaScript functions for toggle and state persistence

### 2. style.css
- Added transition to `.sidebar` for smooth animation
- Added `.sidebar.collapsed` class (left: -240px)
- Added `.sidebar-toggle` button styles
- Added `.sidebar-toggle:hover` hover effect
- Added `.sidebar-toggle .toggle-icon` icon styling
- Added `.sidebar-toggle.shifted` for button repositioning
- Added transition to `.content` for smooth animation
- Added `.content.expanded` class (margin-left: 0)

## How to Use

1. **Open Admin Dashboard**: Navigate to any admin page (Reports, Jobs, Students, Applications, Announcements)
2. **Click Toggle Button**: Click the circular button with ☰ icon at the top-left
3. **Sidebar Hides**: The sidebar slides off-screen to the left, and content expands to full width
4. **Click Again to Show**: Click the toggle button again to bring the sidebar back
5. **State Persists**: Your preference is saved and restored when you navigate to other admin pages

## Benefits

✅ **More Screen Space**: Hide sidebar when viewing tables or detailed content
✅ **Better Responsiveness**: Useful for smaller screens or when zoomed in
✅ **User Preference**: State persists across page navigation
✅ **Smooth Animation**: Professional slide-in/slide-out effect
✅ **Easy Access**: Toggle button always visible and accessible

## Testing Checklist

- [ ] Click toggle button - sidebar should slide left
- [ ] Click again - sidebar should slide back
- [ ] Navigate to different admin pages - state should persist
- [ ] Refresh page - state should persist
- [ ] Hover over toggle button - should turn blue and scale up
- [ ] Check content area expands to full width when sidebar is hidden
- [ ] Test on different screen sizes

## Browser Compatibility

- Chrome/Edge: ✅ Full support
- Firefox: ✅ Full support
- Safari: ✅ Full support
- IE11: ⚠️ Limited support (localStorage works, but transitions may vary)

## Future Enhancements (Optional)

- Add keyboard shortcut (e.g., Ctrl+B) to toggle sidebar
- Add mini-sidebar mode showing only icons instead of full hide
- Add animation for menu items when expanding/collapsing
- Add tooltip on hover for toggle button
